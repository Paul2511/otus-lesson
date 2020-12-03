<?php


namespace App\Services\Auth;


use App\Models\Role;
use App\Models\User;

class AuthService
{
    public function hasUserAbility(User $user, string $model, string $ability): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        if (!$user->isManager()) {
            return false;
        }
        $role = $user->roles()->first();
        if (!$role) {
            return false;
        }

        return $this->hasRoleAbility($role, $model, $ability);

    }

    public function hasRoleAbility(Role $role, string $model, string $ability): bool
    {
        $userAbility = $role->ability();
        if (!isset($userAbility[$model])) {
            return false;
        }

        return in_array($ability, $userAbility[$model]);

    }
}