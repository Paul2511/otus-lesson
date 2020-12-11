<?php


namespace App\Policies;


use App\Models\User;
use App\Services\Auth\AuthService;

abstract class BasePolicy
{

    /**
     * @var AuthService
     */
    protected $authService;

    public function __construct(
        AuthService $authService
    )
    {
        $this->authService = $authService;
    }

    public function before(User $user)
    {
        if ( ($user->isAdmin() && $user->isActive()) ) {
            return true;
        }
        if ( !$user->isManager() && $user->isActive() ) {
            return false;
        }
    }
}
