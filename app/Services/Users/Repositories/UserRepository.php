<?php


namespace App\Services\Users\Repositories;

use App\Models\User;
use Support\Cache\CacheHelper;
class UserRepository
{

    public function findUser(int $userId, ?bool $fromCache=false): User
    {
        return $fromCache ?
            CacheHelper::remember(User::query(), class_basename(User::class), $userId)->findOrFail($userId) :
            User::findOrFail($userId);
    }

    public function updateUser(User $user, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();

        return $user->update($data);
    }

    public function createUser(array $data): User
    {
        $data = collect($data)->whereNotNull()->all();
        return User::create($data);
    }
}