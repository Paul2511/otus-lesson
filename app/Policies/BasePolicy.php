<?php

namespace App\Policies;

use App\Models\User;

class BasePolicy
{
    public function before(User $user)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }
}
