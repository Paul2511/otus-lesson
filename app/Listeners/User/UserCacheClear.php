<?php

namespace App\Listeners\User;

use App\Events\User\UserEvent;
use App\Helpers\CacheHelper;
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
        $userId = $event->getUser()->id;
        User::flushCache(CacheHelper::getKey(User::$modelName, $userId));
    }
}
