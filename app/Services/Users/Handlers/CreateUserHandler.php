<?php

namespace App\Services\Users\Handlers;

use \App\Services\Users\Repositories\EloquentUsersRepository;
use \App\Services\Users\DTO\CreateUserDTO;

class CreateUserHandler {
    
    private EloquentUsersRepository $eloquentUsersRepository;
    
    public function __construct(
        EloquentUsersRepository $eloquentUsersRepository
        ) {
        $this->eloquentUsersRepository = $eloquentUsersRepository;
    }
    
    public function handler(CreateUserDTO $createUserDTO):User{
        $this->eloquentUsersRepository->createFromArray($createUserDTO->toArray());
    }
}
