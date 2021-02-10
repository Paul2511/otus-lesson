<?php


namespace App\Services\Auth;


use App\Models\Role;
use App\Models\User;

class AuthServices
{
    public function hasPermission(User $user, string $model, string $permission): bool
    {
        if ($user->isAdmin())
            return true;


        if ($user->isModerator())
            return false;

        $role = $user->role;

        if (!$role)
            return false;

        return $this->hasRolePermission($role, $model, $permission);
    }

    public function hasRolePermission(Role $role, string $model, string $permission): bool
    {
        if (!isset($role->permissions[$model]))
            return false;

        return in_array($permission, $role->permissions[$model]);
    }
}
