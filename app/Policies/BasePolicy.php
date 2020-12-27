<?php


namespace App\Policies;


use App\Models\User;

abstract class BasePolicy
{
    /**
     * @param User $user
     * @return bool|null
     */
    public function before(User $user):?bool{
      if($user->isAdmin()) {
          return true;
      }
    }
}
