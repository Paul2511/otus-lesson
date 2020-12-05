<?php
namespace App\Service\Handlers;
use App\Models\Todo;
use App\Repositories\EloquentTodoRepository;

class UpdateTodoHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentTodoRepository $todoRepository){
		$this->todoRepository = $todoRepository;
	}

    public function handle(array $data, $id)
    {
    	return $this->todoRepository->update($data, $id);
    }
}