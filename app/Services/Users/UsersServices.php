<?php


namespace App\Services\Users;


use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Repository\EloquentUserRepository;

class UsersServices
{

    public $eloquentUserRepository;
    public $createUserHandler;

    public function __construct(
        EloquentUserRepository $eloquentUserRepository,
        CreateUserHandler $createUserHandler
    )
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
        $this->createUserHandler = $createUserHandler;
    }


}
