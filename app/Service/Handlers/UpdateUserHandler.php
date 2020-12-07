<?php
namespace App\Service\Handlers;
use App\Models\User;
use App\Repositories\EloquentUserRepository;

class UpdateUserHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentUserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

    public function handle($data, $id)
    {
    	return $this->userRepository->update($data, $id);
    }
}