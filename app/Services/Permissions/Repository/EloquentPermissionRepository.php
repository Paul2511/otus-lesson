<?php


namespace App\Services\Permissions\Repository;


use App\Models\Permission;
use App\Services\Permissions\Repository\Interfaces\EloquentPermissionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class EloquentPermissionRepository implements EloquentPermissionRepositoryInterface
{
    public function search(): LengthAwarePaginator
    {
        return Permission::paginate();
    }

    public function findOrFail(int $id): Model
    {
        return Permission::findOrFail($id);
    }

    public function create(array $data): Model
    {
        return Permission::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $model = $this->findOrFail($id);
        return $model->update($data);
    }

    public function delete(int $id): bool
    {
        $model = $this->findOrFail($id);
        return $model->delete();
    }
}
