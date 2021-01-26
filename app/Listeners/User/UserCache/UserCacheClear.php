<?php

namespace App\Listeners\User\UserCache;

use App\Events\User\UserEvent;
use Support\Cache\CacheHelper;
use App\Models\User;

class UserCacheClear
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        if (CacheHelper::isCacheEnabled()) {
            $userId = $event->getUser()->id;
            User::flushCache(CacheHelper::getKey(class_basename(User::class), $userId));
        }
    }
}
