<?php
namespace App\Service\Handlers;
use App\Models\Todo;
use App\Repositories\EloquentTodoRepository;

class UpdateSeveralTodoHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentTodoRepository $todoRepository){
		$this->todoRepository = $todoRepository;
	}

    public function handle(array $data, array $id)
    {
    	return $this->todoRepository->updateSeveral($data, $id);
    }
}