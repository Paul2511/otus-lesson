<?php


namespace App\Services\Users\Repository;


use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class EloquentUserRepository
{
    protected function getQueryBuilder(): Builder
    {
        return User::query();
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
