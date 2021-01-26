<?php

namespace App\Observers;

use App\Services\Users\Cache\UsersCacheService;
use App\Models\User;

class UserObserver
{

    private $usersCacheService;

    public function __construct(UsersCacheService $usersCacheService)
    {
        $this->usersCacheService = $usersCacheService;
    }

    public function created(User $user)
    {
        $this->usersCacheService->clear();
    }

    public function updated(User $user)
    {
        $this->usersCacheService->clear();
    }


    public function deleted(User $user)
    {
        $this->usersCacheService->clear();
    }


    public function restored(User $user)
    {
        $this->usersCacheService->clear();
    }

    public function forceDeleted(User $user)
    {
        $this->usersCacheService->clear();
    }
}
