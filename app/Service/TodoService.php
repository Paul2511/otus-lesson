<?php
namespace App\Service;
use App\Service\Handlers\{CreateTodoHandler, UpdateTodoHandler, DeleteTodoHandler};

class TodoService{
	protected $createTodoHandler;
    protected $updateTodoHandler;
    protected $deleteTodoHandler;

	public function __construct(CreateTodoHandler $createTodoHandler, UpdateTodoHandler $updateTodoHandler, DeleteTodoHandler $deleteTodoHandler)
	{
        $this->createTodoHandler = $createTodoHandler;
        $this->updateTodoHandler = $updateTodoHandler;
        $this->deleteTodoHandler = $deleteTodoHandler;
	}

	public function createTodo($data)
	{
		$this->createTodoHandler->handle($data);
	}
	
	public function updateTodo($data, $id)
	{
		$this->updateTodoHandler->handle($data, $id);
	}
	
	public function deleteTodo($id)
	{
		$this->deleteTodoHandler->handle($id);
	}
	
}