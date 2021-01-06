<?php


namespace App\Services\Users\Repositories;

use App\Helpers\CacheHelper;
use App\Models\UserDetail;
class UserDetailRepository
{

    public function findUserDetailByUserId(int $userId, ?bool $fromCache = false): UserDetail
    {
        return $fromCache ?
            CacheHelper::remember(UserDetail::query(), UserDetail::$modelName, $userId)->where('user_id', $userId)->firstOrFail() :
            UserDetail::whereUserId($userId)->firstOrFail();
    }

    public function setUserDetail(UserDetail $userDetail, array $data): bool
    {
        return $userDetail->fill($data)->save();
    }
}