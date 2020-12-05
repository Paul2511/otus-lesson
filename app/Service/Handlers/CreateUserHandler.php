<?php
namespace App\Service\Handlers;
use App\Models\User;
use App\Repositories\EloquentUserRepository;

class CreateUserHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentUserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

    public function handle(Request $request)
    {
    	$data = $request->only($this->userRepository->getModel()->fillable);
    	return $this->userRepository->create($data);
    }
}