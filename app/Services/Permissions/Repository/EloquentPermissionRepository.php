<?php


namespace App\Services\Permissions\Repository;


use App\Models\Permission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class EloquentPermissionRepository
{
    public function search(): LengthAwarePaginator
    {
        return Permission::paginate();
    }

    public function findOrFail(int $id): Model
    {
        return Permission::findOrFail($id);
    }
}
