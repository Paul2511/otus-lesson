<?php


namespace App\Services\Handlers;


use App\Services\Users\Repositories\EloquentUserRepository;

class CreateUserHandler
{
    /**
     * @var EloquentUserRepository
     */
    private $eloquentUserRepository;


    public function __construct(
        EloquentUserRepository $eloquentUserRepository
    )
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
    }

    public function handle($data)
    {
        $user = $this->eloquentUserRepository->createUser($data);
        $user = $this->eloquentUserRepository->attachRoleToUser($data, $user);
        $user = $this->eloquentUserRepository->attachCompanyToUser($data, $user);
        return $user;
    }
}