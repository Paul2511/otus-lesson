<?php


namespace App\Policies;


use App\Models\Permission;
use App\Models\User;
use App\Services\Auth\Auth\AuthService;

class DashboardGate
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    public function admin(User $user)
    {
       return $this->authService->hasUserPermission(
            $user,
            Gates::CAN_VIEW,
            Permission::ADMIN,
        );
    }

}
