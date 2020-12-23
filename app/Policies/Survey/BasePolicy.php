<?php

namespace App\Policies\Survey;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


abstract class BasePolicy
{
    use HandlesAuthorization;


    /**
     * @param User $user
     *
     * @return bool
     */
    public function before(User $user): ?bool
    {
        if ($user->isAdmin()) return true;
        // if (!$user->isModerator()) return false;

        return null;
    }
}
