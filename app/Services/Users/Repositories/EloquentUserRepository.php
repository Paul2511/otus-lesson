<?php


namespace App\Services\Users\Repositories;

use App\Models\User;
use App\Services\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;


class EloquentUserRepository implements BaseRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @param array $data
     * @return User|null
     */
    public function createByArray(array $data): ?User
    {
        return $this->user->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function updateByArray(array $data, int $id): void
    {
        $this->user->find($id)->update($data);
    }

    /**
     * @param int $id
     */
    public function deleteById(int $id): void
    {
        $this->user->find($id)->delete();
    }


    /**
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return $this->user->newQuery();
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return $this->user->find($id);
    }
}
