<?php


namespace App\Services\Handlers;


use App\Services\Users\Repositories\EloquentUserRepository;

class UpdateUserHandler
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

    public function handle(array $data, int $id)
    {
        $user = $this->eloquentUserRepository->updateUserById($data, $id);
        $user = $this->eloquentUserRepository->attachRoleToUser($data, $user);

        return $user;
    }
}