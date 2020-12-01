<?php


namespace App\Services\Roles;


use App\Services\Roles\Handlers\CreateRoleHandler;
use App\Services\Roles\Handlers\DeleteRoleHandler;
use App\Services\Roles\Handlers\UpdateRoleHandler;
use App\Services\Roles\Repository\EloquentRoleRepository;

class RolesServices
{
    private EloquentRoleRepository $eloquentRoleRepository;
    private CreateRoleHandler $createRoleHandler;
    private UpdateRoleHandler $updateRoleHandler;
    private DeleteRoleHandler $deleteRoleHandler;

    public function __construct(
        EloquentRoleRepository $eloquentRoleRepository,
        CreateRoleHandler $createRoleHandler,
        UpdateRoleHandler $updateRoleHandler,
        DeleteRoleHandler $deleteRoleHandler
    )
    {
        $this->eloquentRoleRepository = $eloquentRoleRepository;
        $this->createRoleHandler = $createRoleHandler;
        $this->updateRoleHandler = $updateRoleHandler;
        $this->deleteRoleHandler = $deleteRoleHandler;
    }

    public function getRoles()
    {
        return $this->eloquentRoleRepository->search();
    }

    public function findRole(int $id)
    {
        return $this->eloquentRoleRepository->findOrFail($id);
    }

    public function storeRole(array $data)
    {
        return $this->createRoleHandler->create($data);
    }

    public function updateRole(array $data, int $id)
    {
        $model = $this->findRole($id);
        return $this->updateRoleHandler->updateRole($data, $model);
    }

    public function deleteRole(int $id)
    {
        $model = $this->findRole($id);
        return $this->deleteRoleHandler->deleteRole($model);
    }

}
