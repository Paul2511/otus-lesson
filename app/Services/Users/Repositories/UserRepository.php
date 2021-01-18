<?php


namespace App\Services\Users\Repositories;

use App\Models\User;
use App\Helpers\CacheHelper;
class UserRepository
{

    public function findUser(int $userId, ?bool $fromCache=false): User
    {
        return $fromCache ?
            CacheHelper::remember(User::query(), class_basename(User::class), $userId)->findOrFail($userId) :
            User::findOrFail($userId);
    }


    public function findUserWithDetail(int $userId): User
    {
        return User::whereId($userId)->with('userDetail')->firstOrFail();
    }


    public function setUser(User $user, array $data): bool
    {
        return $user->fill($data)->save();
    }

    public function createUser(array $data): User
    {
        return User::create($data);
    }
}