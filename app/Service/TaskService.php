<?php
namespace App\Service;
use App\Service\Handlers\{CreateTaskHandler, UpdateTaskHandler, DeleteTaskHandler, GiveMeTaskHandler, GiveMeAllTaskHandler};
class TaskService{
	protected $createTaskHandler;
    protected $updateTaskHandler;
    protected $deleteTaskHandler;
    protected $giveMeTaskHandler;
    protected $giveMeAllTaskHandler;

	public function __construct(CreateTaskHandler $createTaskHandler, UpdateTaskHandler $updateTaskHandler, DeleteTaskHandler $deleteTaskHandler, GiveMeTaskHandler $giveMeTaskHandler, GiveMeAllTaskHandler $giveMeAllTaskHandler)
	{
        $this->createTaskHandler = $createTaskHandler;
        $this->updateTaskHandler = $updateTaskHandler;
        $this->deleteTaskHandler = $deleteTaskHandler;
        $this->giveMeTaskHandler = $giveMeTaskHandler;
        $this->giveMeAllTaskHandler = $giveMeAllTaskHandler;
	}

	public createTask($request)
	{
		$this->createTaskHandler->handle($request);
	}
	
	public updateTask($request, $id)
	{
		$this->updateTaskHandler->handle($request, $id);
	}
	
	public deleteTask($id)
	{
		$this->deleteTaskHandler->handle($id);
	}
	
	public giveMeAllTask()
	{
		return $this->giveMeAllTaskHandler->handle();
	}

	public giveMeTask($id)
	{
		return $this->giveMeTaskHandler->handle($id);
	}
}