<?php
namespace App\Service\Handlers;
use App\Models\Task;
use App\Repositories\EloquentTaskRepository;

class CreateTaskHandler implements HandlerInterface
{
	private $taskRepository;

	public function __construct(EloquentUserRepository $taskRepository){
		$this->taskRepository = $taskRepository;
	}

    public function handle(Request $request)
    {
    	$data = $request->only($this->taskRepository->getModel()->fillable);
    	return $this->taskRepository->create($data);
    }
}