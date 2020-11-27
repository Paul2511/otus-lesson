<?php


namespace App\Services\Users\Repository;


use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class EloquentUserRepository
{
    public function search(): LengthAwarePaginator
    {
        return User::paginate();
    }

    public function findOrFail(int $id): Model
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        User::create($data);
    }

}
