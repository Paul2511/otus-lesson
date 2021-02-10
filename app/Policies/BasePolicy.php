<?php


namespace App\Policies;


use App\Models\User;
use App\Services\Auth\AuthServices;

abstract class BasePolicy
{

    protected AuthServices $authServices;

    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
