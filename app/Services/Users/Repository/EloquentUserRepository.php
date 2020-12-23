<?php


namespace App\Services\Users\Repository;


use App\Models\User;
use App\Services\Users\Repository\Interfaces\EloquentUserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;


class EloquentUserRepository implements EloquentUserRepositoryInterface
{
    public function create(array $data): Model
    {
        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->findOrFail($id);
        return $user->update($data);
    }

    public function delete(int $id): bool
    {
        $user = $this->findOrFail($id);
        return $user->delete();
    }

    public function search(): LengthAwarePaginator
    {
        return User::paginate();
    }

    public function findOrFail(int $id): Model
    {
        return User::findOrFail($id);
    }
}
