<?php


namespace App\Services\UserRole\Repository;


use App\Models\UserRole;
use Illuminate\Database\Eloquent\Model;
use App\Services\UserRole\Repository\Interfaces\EloquentUserRoleRepositoryInterface;

class EloquentUserRoleRepository implements EloquentUserRoleRepositoryInterface
{

    public function setRoleOnUser(int $userId, int $roleId): bool
    {
        UserRole::create(['user_id' => $userId, 'role_id' => $roleId]);
        return true;
    }

}
