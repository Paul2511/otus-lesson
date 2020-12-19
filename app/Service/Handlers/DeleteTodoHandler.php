<?php
namespace App\Service\Handlers;
use App\Models\Todo;
use App\Repositories\EloquentTodoRepository;

class DeleteTodoHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentTodoRepository $todoRepository){
		$this->todoRepository = $todoRepository;
	}

    public function handle($id)
    {
    	return $this->todoRepository->delete($id);
    }
}