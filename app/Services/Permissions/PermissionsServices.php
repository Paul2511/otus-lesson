<?php


namespace App\Services\Permissions;


use App\Services\Permissions\Handlers\CreatePermissionHandler;
use App\Services\Permissions\Handlers\DeletePermissionHandler;
use App\Services\Permissions\Handlers\UpdatePermissionHandler;
use App\Services\Permissions\Repository\EloquentPermissionRepository;

class PermissionsServices
{
    private EloquentPermissionRepository $eloquentPermissionRepository;
    private CreatePermissionHandler $createPermissionHandler;
    private UpdatePermissionHandler $updatePermissionHandler;
    private DeletePermissionHandler $deletePermissionHandler;

    public function __construct(
        EloquentPermissionRepository $eloquentPermissionRepository,
        CreatePermissionHandler $createPermissionHandler,
        UpdatePermissionHandler $updatePermissionHandler,
        DeletePermissionHandler $deletePermissionHandler
    )
    {
        $this->eloquentPermissionRepository = $eloquentPermissionRepository;
        $this->createPermissionHandler = $createPermissionHandler;
        $this->updatePermissionHandler = $updatePermissionHandler;
        $this->deletePermissionHandler = $deletePermissionHandler;
    }

    public function getPermission()
    {
        return $this->eloquentPermissionRepository->search();

    }

    public function findPermission(int $id)
    {
        return $this->eloquentPermissionRepository->findOrFail($id);

    }

    public function storePermission(array $data)
    {
        return $this->createPermissionHandler->create($data);
    }

    public function updatePermission(array $data, int $id)
    {
        $model = $this->findPermission($id);
        return $this->updatePermissionHandler->updatePermission($data, $model);
    }

    public function deletePermission(int $id)
    {
        $model = $this->findPermission($id);
        return $this->deletePermissionHandler->deletePermission($model);
    }

}
