<?php

namespace App\Services\Handlers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CheckUserPasswordHandler
{
    public function handle(User $user, $password): ?User
    {
        if ($user && $user->is_active &&
            Hash::check($password, $user->password)) {
            return $user;
        }
        return null;
    }

}
