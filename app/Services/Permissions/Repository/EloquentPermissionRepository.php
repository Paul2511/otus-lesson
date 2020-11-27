<?php


namespace App\Services\Permissions\Repository;


use App\Models\Permission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EloquentPermissionRepository
{

    protected function getQueryBuilder(): Builder
    {
        return Permission::query();
    }

    public function search(): LengthAwarePaginator
    {
        return $this->getQueryBuilder()->paginate();
    }

    public function findOrFail(int $id): Model
    {
        return $this->getQueryBuilder()->findOrFail($id);
    }

    public function create(array $data)
    {
        $this->getQueryBuilder()->create($data);
    }

}
