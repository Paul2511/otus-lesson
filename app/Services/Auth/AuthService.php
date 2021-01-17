<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Users\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthService
{
    private UsersService $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function login(Request $request)
    {
      $user = $this->usersService->findUserByEmail($request->email);
        if (empty($user)) {
            return false;
        }
        $user = $this->usersService->checkUserActiveAndPassword($user, $request->password);

        if (empty($user)) {
            return false;
        }
      return $this->usersService->updateAuthData($user);
    }

    public function hasUserPermission(User $user, int $resource_id): bool
    {
        if (empty($user)) {
            return false;
        }
        if ($user->isAdmin()) {
            return true;
        }
        return $this->usersService->hasUserPermission($user, $resource_id);
    }
}
