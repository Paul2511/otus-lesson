<?php


namespace App\Services\Roles\Repository;


use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class EloquentRoleRepository
{
    public function search(): LengthAwarePaginator
    {
        return Role::paginate();
    }

    public function findOrFail(int $id): Model
    {
        return Role::findOrFail($id);
    }
}
