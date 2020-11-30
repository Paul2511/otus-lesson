<?php


namespace App\Services\Users\Repositories;

use App\Models\User;

class UserRepository
{
    public function getUser(int $id): User
    {
        return User::findOrFail($id);
    }


    public function getUserWithDetail(int $id): User
    {
        return User::whereId($id)->with('detail')->firstOrFail();
    }

    public function setUserWithDetail(User $user, array $data): User
    {
        $detail = $user->detail;

        $detail->fill($data['detail'])->save();
        $user->fill($data)->save();

        $user->fresh();

        return $user;
    }
}