<?php


namespace App\Services\Users;


use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\DeleteUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Repository\EloquentUserRepository;

class UsersServices
{

    private EloquentUserRepository $eloquentUserRepository;
    private CreateUserHandler $createUserHandler;
    private UpdateUserHandler $updateUserHandler;
    private DeleteUserHandler $deleteUserHandler;

    public function __construct(
        EloquentUserRepository $eloquentUserRepository,
        CreateUserHandler $createUserHandler,
        UpdateUserHandler $updateUserHandler,
        DeleteUserHandler $deleteUserHandler
    )
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->deleteUserHandler = $deleteUserHandler;
    }

    public function getUsers()
    {
        return $this->eloquentUserRepository->search();
    }

    public function storeUser(array $data)
    {
        $this->createUserHandler->create(array($data));
    }

    public function deleteUser(int $id)
    {
        $model = $this->findUser($id);
        return $this->deleteUserHandler->deleteUser($model);
    }

    public function updateUser(array $data, int $id)
    {
        $model = $this->findUser($id);
        return $this->updateUserHandler->updateUser($data, $model);
    }

    public function findUser(int $id)
    {
        return $this->eloquentUserRepository->findOrFail($id);
    }


}
