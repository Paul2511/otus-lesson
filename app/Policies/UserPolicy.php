<?php

namespace App\Policies;

use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\Resources\Resources;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy extends BasePolicy
{
    use HandlesAuthorization;

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function viewAny(User $user)
    {
    }

    public function view(User $user, User $model):bool
    {
        return $user->id === $model->id;
    }

    public function viewResource(User $user, int $resource_id):bool
    {
        return $this->authService->hasUserPermission($user, $resource_id);
    }

    public function create(User $user)
    {

    }

    public function update(User $user, User $model)
    {

    }
    public function activate(User $user, User $model)
    {

    }

    public function delete(User $user, User $model)
    {

    }

    public function restore(User $user, User $model)
    {

    }

    public function forceDelete(User $user, User $model)
    {

    }
}
