<?php
namespace App\Service\Handlers;
use App\Models\Task;
use App\Repositories\EloquentTaskRepository;

class GiveMeTaskHandler implements HandlerInterface
{
	private $taskRepository;

	public function __construct(EloquentTaskRepository $taskRepository){
		$this->taskRepository = $taskRepository;
	}

    public function handle($id)
    {
    	return $this->taskRepository->show($id);
    }
}