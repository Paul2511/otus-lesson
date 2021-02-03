<?php


namespace App\Services\Auth\Auth;

use App\Models\Role;
use App\Models\User;


class AuthService
{
    public function hasUserPermission(User $user, string $permission): bool
    {

        if ($this->isAdminUser($user)) {
            return true;
        }

        $role = $user->roles()->first();

        if (!isset($role)) {
            return false;
        }

        return $this->hasRolePermission($role, $permission);
    }

    private function hasRolePermission(Role $role, string $permission): bool
    {
        return in_array($permission, $role->permissions()->get()->toArray()[0]);
    }

    public function isAdminUser(User $user): bool
    {
        return $user->isAdmin();
    }


}
