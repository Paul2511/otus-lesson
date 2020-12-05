<?php
namespace App\Service\Handlers;
use App\Models\Task;
use App\Repositories\EloquentTaskRepository;

class DeleteTaskHandler implements HandlerInterface
{
	private $taskRepository;

	public function __construct(EloquentTaskRepository $taskRepository){
		$this->taskRepository = $taskRepository;
	}

    public function handle()
    {
    	return $this->taskRepository->delete($id);
    }
}