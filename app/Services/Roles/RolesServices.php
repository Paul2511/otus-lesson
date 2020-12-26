<?php


namespace App\Services\Roles;


use App\Services\Roles\Handlers\CreateRoleHandler;
use App\Services\Roles\Handlers\DeleteRoleHandler;
use App\Services\Roles\Handlers\UpdateRoleHandler;
use App\Services\Roles\Repository\EloquentRoleRepository;
use App\Services\Roles\Repository\Interfaces\EloquentRoleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class RolesServices
{
    private EloquentRoleRepositoryInterface $eloquentRoleRepository;

    public function __construct(
        EloquentRoleRepositoryInterface $eloquentRoleRepository
    )
    {
        $this->eloquentRoleRepository = $eloquentRoleRepository;
    }

    public function getRoles(): LengthAwarePaginator
    {
        return $this->eloquentRoleRepository->search();
    }

    public function findRole(int $id): Model
    {
        return $this->eloquentRoleRepository->findOrFail($id);
    }

    public function storeRole(array $data): Model
    {
        return $this->eloquentRoleRepository->create($data);
    }

    public function updateRole(array $data, int $id): bool
    {
        return $this->updateRoleHandler->updateRole($data, $model);
    }

    public function deleteRole(int $id): bool
    {
        $model = $this->findRole($id);
        return $this->deleteRoleHandler->deleteRole($model);
    }

}
