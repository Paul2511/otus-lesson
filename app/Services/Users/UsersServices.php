<?php


namespace App\Services\Users;


use App\Services\Users\Repository\EloquentUserRepository;

class UsersServices
{

    public $eloquentUserRepository;

    public function __construct(EloquentUserRepository $eloquentUserRepository)
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
    }

}
