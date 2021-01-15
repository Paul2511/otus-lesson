<?php


namespace App\Services\Auth\Auth;


use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;

class AuthService
{
    public function hasUserPermission(User $user, string $model, string $permission): bool
    {

        if ($user->isAdmin()) {
            return true;
        }

        $role = $user->hasRole;

        if (!$role) {
            return false;
        }
        return $this->hasRolePermission($role, $model, $permission);
    }

    private function hasRolePermission(Role $role, string $model, string $permission): bool
    {


        if (!isset($role->permissions[$model])) {
            return false;
        }

        return in_array($permission, $role->permissions[$model]);
    }


}
