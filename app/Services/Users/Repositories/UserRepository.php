<?php


namespace App\Services\Users\Repositories;

use App\Models\User;

class UserRepository
{
    public function findUser(int $id): User
    {
        return User::findOrFail($id);
    }


    public function findUserWithDetail(int $id): User
    {
        return User::whereId($id)->with('detail')->firstOrFail();
    }

    public function setUser(User $user, array $data): bool
    {
        return $user->fill($data)->save();
    }
}