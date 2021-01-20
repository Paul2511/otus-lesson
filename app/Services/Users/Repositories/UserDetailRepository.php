<?php


namespace App\Services\Users\Repositories;

use App\Helpers\CacheHelper;
use App\Models\UserDetail;
class UserDetailRepository
{

    public function findUserDetailByUserId(int $userId, ?bool $fromCache = false): UserDetail
    {
        return $fromCache ?
            CacheHelper::remember(UserDetail::query(), class_basename(UserDetail::class), $userId)->where('user_id', $userId)->firstOrFail() :
            UserDetail::whereUserId($userId)->firstOrFail();
    }

    public function setUserDetail(UserDetail $userDetail, array $data): bool
    {
        return $userDetail->fill($data)->save();
    }

    public function createUserDetail(array $data): UserDetail
    {
        return UserDetail::create($data);
    }

}