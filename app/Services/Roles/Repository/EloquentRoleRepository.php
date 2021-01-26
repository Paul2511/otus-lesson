<?php


namespace App\Services\Roles\Repository;


use App\Models\Role;
use App\Services\Roles\Repository\Interfaces\EloquentRoleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class EloquentRoleRepository implements EloquentRoleRepositoryInterface
{
    public function create(array $data): Model
    {
        return Role::create($data);
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

    public function search(): LengthAwarePaginator
    {
        return Role::paginate();
    }

    public function findOrFail(int $id): Model
    {
        return Role::findOrFail($id);
    }

    public function getDefaultRole(): Model
    {
        return Role::where('title', self::DEFAULT_ROLE)->first();
    }
}
