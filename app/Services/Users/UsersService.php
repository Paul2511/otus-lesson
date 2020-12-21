<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\Handlers\ActivateUserHandler;
use App\Services\Handlers\CreateUserHandler;
use App\Services\Handlers\GetUsersHandler;
use App\Services\Handlers\UpdateUserHandler;
use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Support\Collection;

class UsersService
{

    private $createUserHandler;
    private $getUsersHandler;
    private $updateUserHandler;
    private $activateUserHandler;
    private $eloquentUserRepository;

    public function __construct(
        CreateUserHandler $createUserHandler,
        GetUsersHandler $getUsersHandler,
        UpdateUserHandler $updateUserHandler,
        ActivateUserHandler $activateUserHandler,
        EloquentUserRepository $eloquentUserRepository
    ) {
        $this->createUserHandler = $createUserHandler;
        $this->getUsersHandler = $getUsersHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->activateUserHandler = $activateUserHandler;
        $this->eloquentUserRepository = $eloquentUserRepository;
    }

    public function getResourceIds(int $id): array
    {
        $resources = [];
        $resources_user = $this->eloquentUserRepository->findById($id, ['resource_user','project_user']);
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
        $projects_user = $this->eloquentUserRepository->findById($id, ['resource_user','project_user']);
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
        return $this->activateUserHandler->handle($userId, $data['is_active']);
    }

}
