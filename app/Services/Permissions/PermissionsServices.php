<?php


namespace App\Services\Permissions;

use App\Services\Permissions\Repository\Interfaces\EloquentPermissionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class PermissionsServices
{
    private EloquentPermissionRepositoryInterface $eloquentPermissionRepository;

    public function __construct(
        EloquentPermissionRepositoryInterface $eloquentPermissionRepository
    )
    {
        $this->eloquentPermissionRepository = $eloquentPermissionRepository;
    }

    public function getPermissions(): LengthAwarePaginator
    {
        return $this->eloquentPermissionRepository->search();

    }

    public function findPermission(int $id): Model
    {
        return $this->eloquentPermissionRepository->findOrFail($id);

    }

    public function storePermission(array $data): Model
    {
        return $this->eloquentPermissionRepository->create($data);
    }

    public function updatePermission(array $data, int $id): bool
    {
        return $this->eloquentPermissionRepository->update($id, $data);
    }

    public function deletePermission(int $id): bool
    {
        return $this->eloquentPermissionRepository->delete($id);
    }

}
