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

	public createTodo($request)
	{
		$this->createTodoHandler->handle($request);
	}
	
	public updateTodo($data, $id)
	{
		$this->updateTodoHandler->handle($data, $id);
	}
	
	public deleteTodo($id)
	{
		$this->deleteTodoHandler->handle($id);
	}
	
	public giveMeAllTodo()
	{
		return $this->giveMeAllTodoHandler->handle();
	}

	public giveMeTodo($id)
	{
		return $this->giveMeTodoHandler->handle($id);
	}
}