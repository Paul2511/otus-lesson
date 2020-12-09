<?php


namespace App\Services\Auth;


use App\Models\Role;
use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;


class AuthService
{
    /**
     * @var EloquentUserRepository
     */
    private EloquentUserRepository $eloquentUserRepository;

    public function __construct
    (
        EloquentUserRepository $eloquentUserRepository
    )
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
    }

    public function hasUserAbility(User $user, string $model, string $ability): bool
    {
        if (!$user->isActive()) {
            return false;
        }
        if ($user->isAdmin()) {
            return true;
        }
        if (!$user->isManager()) {
            return false;
        }

        $role = $user->role;

        return $this->hasRoleAbility($role, $model, $ability);

    }

    public function hasRoleAbility(Role $role, string $model, string $ability): bool
    {
        $userAbilities = $role->abilities();
        if (!isset($userAbilities[$model])) {
            return false;
        }

        return in_array($ability, $userAbilities[$model]);

    }

    public function assignRole(int $roleName, User $user)
    {
        $roleId = $this->eloquentUserRepository->findRoleByName($roleName);
        $user->role()->associate($roleId)->save();

        return $user;
    }

}