<?php
namespace App\Service;
use App\Service\Handlers\{CreateTodoHandler, UpdateSeveralTodoHandler, DeleteTodoHandler};

class TodoService{
	protected $createTodoHandler;
    protected $updateSeveralTodoHandler;
    protected $deleteTodoHandler;

	public function __construct(CreateTodoHandler $createTodoHandler, UpdateSeveralTodoHandler $updateSeveralTodoHandler, DeleteTodoHandler $deleteTodoHandler)
	{
        $this->createTodoHandler = $createTodoHandler;
        $this->updateSeveralTodoHandler = $updateSeveralTodoHandler;
        $this->deleteTodoHandler = $deleteTodoHandler;
	}

	public function createTodo($data)
	{
		$this->createTodoHandler->handle($data);
	}
	
	public function updateTodos($data, $id)
	{
		$this->updateSeveralTodoHandler->handle($data, $id);
	}
	
	public function deleteTodo($id)
	{
		$this->deleteTodoHandler->handle($id);
	}
	
}