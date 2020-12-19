<?php
namespace App\Service\Handlers;
use App\Models\User;
use App\Repositories\EloquentUserRepository;

class DeleteUserHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentUserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

    public function handle()
    {
    	return $this->userRepository->delete($id);
    }
}