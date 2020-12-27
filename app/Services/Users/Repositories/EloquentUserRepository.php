<?php


namespace App\Services\Users\Repositories;

use App\Models\User;

class EloquentUserRepository
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
     */
    public function createByArray(array $data): void
    {
        $this->user->create($data);
    }

    /**
     * @param User $user
     * @param array $data
     */
    public function updateByArray(User $user, array $data): void
    {
        $this->user->find($user->id)->update($data);
    }

    public function deleteById(int $id){
        $this->user->find($id)->delete();
    }
}
