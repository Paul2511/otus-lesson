<?php

namespace App\Listeners\UserDetail;

use App\Events\UserDetail\UserDetailEvent;
use App\Helpers\CacheHelper;
use App\Models\UserDetail;

class UserDetailCacheClear
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

    public function handle(UserDetailEvent $event)
    {
        $userId = $event->getUserDetail()->user_id;
        $key = CacheHelper::getKey(UserDetail::$modelName, $userId);
        UserDetail::flushCache($key);
    }
}
