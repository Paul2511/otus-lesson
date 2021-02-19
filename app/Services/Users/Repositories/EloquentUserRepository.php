<?php


namespace App\Services\Users\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
class EloquentUserRepository extends UserRepository
{
    public function findById(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * @return User[]|\Illuminate\Database\Eloquent\Builder[]|Collection
     */
    public function get()
    {
        return $this->query->get();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage)
    {
        return $this->query->paginate($perPage);
    }

    public function create(array $data): User
    {
        $data = collect($data)->whereNotNull()->all();

        return User::create($data);
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(User $user)
    {
        return $user->delete();
    }

    public function update(User $user, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();

        return $user->update($data);
    }
}