<?php

namespace App\Policies;

use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function __construct(
        AuthService $authService
    )
    {
        $this->authService = $authService;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $this->authService->hasUserAbility(
            $user,
            User::class,
            Ability::VIEW_ANY);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function view(User $user)
    {
        return $this->authService->hasUserAbility(
            $user,
            User::class,
            Ability::VIEW);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->authService->hasUserAbility(
            $user,
            User::class,
            Ability::CREATE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->authService->hasUserAbility(
            $user,
            User::class,
            Ability::UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->authService->hasUserAbility(
            $user,
            User::class,
            Ability::DELETE);
    }

    public function store(User $user)
    {
        return $this->authService->hasUserAbility(
            $user,
            User::class,
            Ability::STORE);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $this->authService->hasUserAbility(
            $user,
            User::class,
            Ability::STORE);
    }
}
