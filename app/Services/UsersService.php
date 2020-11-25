<?php


namespace App\Services;


use App\Services\Handlers\CreateUserHandler;
use App\Services\Handlers\DeleteUserHandler;
use App\Services\Handlers\PaginateUsersHandler;
use App\Services\Handlers\ShowUserHandler;
use App\Services\Handlers\UpdateUserHandler;
use App\Services\Users\Translators\UserRolesTranslator;
use App\Services\Users\Translators\UserStatusTranslator;


class UsersService
{
    private $userStatusTranslator;
    private $userRolesTranslator;
    private $createUserHandler;
    private $paginateUsersHandler;
    private $showUserHandler;
    private $updateUserHandler;
    private $deleteUserHandler;

    /**
     * UsersService constructor.
     * @param UserStatusTranslator $userStatusTranslator
     * @param UserRolesTranslator $userRolesTranslator
     * @param CreateUserHandler $createUserHandler
     * @param PaginateUsersHandler $paginateUsersHandler
     * @param ShowUserHandler $showUserHandler
     * @param DeleteUserHandler $deleteUserHandler
     * @param UpdateUserHandler $updateUserHandler
     */
    public function __construct(

        UserStatusTranslator $userStatusTranslator,
        UserRolesTranslator $userRolesTranslator,
        CreateUserHandler $createUserHandler,
        PaginateUsersHandler $paginateUsersHandler,
        ShowUserHandler $showUserHandler,
        UpdateUserHandler $updateUserHandler,
        DeleteUserHandler $deleteUserHandler

    )
    {
        $this->userStatusTranslator = $userStatusTranslator;
        $this->userRolesTranslator = $userRolesTranslator;
        $this->createUserHandler = $createUserHandler;
        $this->paginateUsersHandler = $paginateUsersHandler;
        $this->showUserHandler = $showUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->deleteUserHandler = $deleteUserHandler;

    }

    public function translateStatus(string $lang): array
    {
        return $this->userStatusTranslator->translate($lang);
    }

    public function translateRoles(string $lang): array
    {
        return $this->userRolesTranslator->translate($lang);
    }

    public function createUser($data)
    {
        return $this->createUserHandler->handle($data);
    }

    public function paginateUsers(int $perPage)
    {
        return $this->paginateUsersHandler->handle($perPage);
    }

    public function showUser(int $id)
    {
        return $this->showUserHandler->handle($id);
    }

    public function updateUser(array $data, int $id)
    {
        return $this->updateUserHandler->handle($data, $id);
    }

    public function deleteUser(int $id)
    {
        return $this->deleteUserHandler->handle($id);
    }
}