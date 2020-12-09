<?php

namespace App\Services\Users\Handlers;

use \App\Services\Users\Repositories\EloquentUsersRepository;
use \App\Services\Users\DTO\UpdateUserDTO;

class UpdateUserHandler {
    
    private EloquentUsersRepository $eloquentUsersRepository;
    
    public function __construct(
        EloquentUsersRepository $eloquentUsersRepository
        ) {
        $this->eloquentUsersRepository = $eloquentUsersRepository;
    }
    
    public function handler(UpdateUserDTO $updateUserDTO):User{
        $this->eloquentUsersRepository->updateFromArray($updateUserDTO->toArray());
    }
}
