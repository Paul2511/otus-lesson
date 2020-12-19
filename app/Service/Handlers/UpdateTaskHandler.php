<?php
namespace App\Service\Handlers;
use App\Models\Task;
use App\Repositories\EloquentTaskRepository;

class UpdateTaskHandler implements HandlerInterface
{
	private $taskRepository;

	public function __construct(EloquentTaskRepository $taskRepository){
		$this->taskRepository = $userRepository;
	}

    public function handle($data, int $id)
    {
    	return $this->taskRepository->update($data, $id);
    }
}