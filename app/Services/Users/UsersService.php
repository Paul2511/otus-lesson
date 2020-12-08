<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\Handlers\ActiveUserHandler;
use App\Services\Handlers\CreateUserHandler;
use App\Services\Handlers\GetUsersHandler;
use App\Services\Handlers\ShowUserHandler;
use App\Services\Handlers\UpdateUserHandler;

use Illuminate\Support\Collection;

class UsersService
{

    private $createUserHandler;
    private $showUserHandler;
    private $getUsersHandler;
    private $updateUserHandler;
    private $activeUserHandler;



    public function __construct(
        CreateUserHandler $createUserHandler,
        GetUsersHandler $getUsersHandler,
        ShowUserHandler $showUserHandler,
        UpdateUserHandler $updateUserHandler,
        ActiveUserHandler $activeUserHandler

    ) {
        $this->createUserHandler = $createUserHandler;
        $this->showUserHandler = $showUserHandler;
        $this->getUsersHandler = $getUsersHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->activeUserHandler = $activeUserHandler;
    }

    public function getResourceIds(int $id): array
    {
        $resources = [];
        $resources_user = $this->showUserHandler->handle($id);
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

    public function activeUser(int $userId, array $data)
    {
        return $this->activeUserHandler->handle($userId, $data['is_active']);
    }

}
