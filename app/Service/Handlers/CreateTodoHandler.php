<?php
namespace App\Service\Handlers;
use App\Models\Todo;
use App\Repositories\EloquentTodoRepository;

class CreateTodoHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentTodoRepository $todoRepository){
		$this->todoRepository = $todoRepository;
	}

    public function handle(Request $request)
    {
    	$data = $request->only($this->todoRepository->getModel()->fillable);
    	return $this->todoRepository->create($data);
    }
}