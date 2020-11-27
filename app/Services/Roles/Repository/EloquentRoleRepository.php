<?php


namespace App\Services\Roles\Repository;


use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EloquentRoleRepository
{
    protected function getQueryBuilder(): Builder
    {
        return Role::query();
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
