<?php


namespace App\Services\Auth\Auth;

use App\Models\Role;
use App\Models\User;


class AuthService
{
    public function hasUserPermission(User $user, string $permission): bool
    {

        if ($user->isAdmin()) {
            return true;
        }

        $role = $user->hasRole;

        if (!$role) {
            return false;
        }
        return $this->hasRolePermission($role, $permission);
    }

    private function hasRolePermission(Role $role, string $permission): bool
    {

        return in_array($permission, $role->permissions()->get()->toArray());
    }


}
