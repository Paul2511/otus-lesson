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

    public function handle(Request $request, $id)
    {
    	$data = $request->only($this->taskRepository->getModel()->fillable);
    	return $this->taskRepository->update($data, $id);
    }
}