<?php


namespace App\Services\Users\Repositories;

use App\Models\UserDetail;

class UserDetailRepository
{
    public function findUserDetail(int $id): UserDetail
    {
        return $this->_model = UserDetail::findOrFail($id);
    }

    public function setUserDetail(UserDetail $userDetail, array $data): bool
    {
        return $userDetail->fill($data)->save();
    }
}