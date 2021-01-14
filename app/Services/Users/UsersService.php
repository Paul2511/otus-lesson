<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\Handlers\ActivateUserHandler;
use App\Services\Handlers\CheckUserPasswordHandler;
use App\Services\Handlers\CheckUserPermissionHandler;
use App\Services\Handlers\CreateUserHandler;
use App\Services\Handlers\FindUserByEmailHandler;
use App\Services\Handlers\GetUsersHandler;
use App\Services\Handlers\ShowUserHandler;
use App\Services\Handlers\UpdateUserHandler;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UsersService
{

    private $createUserHandler;
    private $showUserHandler;
    private $getUsersHandler;
    private $updateUserHandler;
    private $activateUserHandler;
    private $findUserByEmailHandler;
    private $checkUserActiveAndPassword;
    private $checkUserPermissionHandler;

    public function __construct(
        CreateUserHandler $createUserHandler,
        GetUsersHandler $getUsersHandler,
        ShowUserHandler $showUserHandler,
        UpdateUserHandler $updateUserHandler,
        ActivateUserHandler $activateUserHandler,
        FindUserByEmailHandler $findUserByEmailHandler,
        CheckUserPasswordHandler $checkUserActiveAndPassword,
        CheckUserPermissionHandler $checkUserPermissionHandler

    ) {
        $this->createUserHandler = $createUserHandler;
        $this->showUserHandler = $showUserHandler;
        $this->getUsersHandler = $getUsersHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->activateUserHandler = $activateUserHandler;
        $this->findUserByEmailHandler = $findUserByEmailHandler;
        $this->checkUserActiveAndPassword = $checkUserActiveAndPassword;
        $this->checkUserPermissionHandler = $checkUserPermissionHandler;
    }

    public function getResourceIds(int $id): array
    {
        $resources = [];
        $resources_user = $this->findUser($id);
        foreach ($resources_user->resource_user->toArray() as $res)
        {
            $resources[] = $res['resource_id'];
        }
        return $resources;
    }

    public function getUsers(): Collection
    {
        return $users = $this->getUsersHandler->handle();
    }

    public function getUserProjects(int $id): array
    {
        $projects = [];
        $projects_user = $this->showUserHandler->handle($id);
        foreach ($projects_user->project_user->toArray() as $res)
        {
            $projects[] = $res['project'];
        }
        return $projects;
    }

    public function createUser(array $data): User
    {
        return $this->createUserHandler->handle($data);
    }

    public function updateUser(int $id, array $data)
    {
        return $this->updateUserHandler->handle($id, $data);
    }

    public function activateUser(int $userId, array $data)
    {
        return $this->activateUserHandler->handle($userId, $data['is_active']);
    }

    public function findUserByEmail(string $email): ?User
    {
        return $this->findUserByEmailHandler->handle($email);
    }

    /**
     * @return Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findUser(string $id)
    {
        return $this->showUserHandler->handle($id);
    }

    public function checkUserActiveAndPassword(User $user, $password): ?User
    {
        return $this->checkUserActiveAndPassword->handle($user, $password);
    }

    public function updateAuthData(User $user)
    {
        return $this->updateUserHandler->handle($user->id, [ 'last_visit' => date('Y-m-d H:i:s')]);
    }

    public function hasUserPermission(User $user, int $resource_id): bool
    {
        return $this->checkUserPermissionHandler->handle($user, $resource_id);
    }


}
