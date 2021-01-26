<?php

namespace App\Services\Users\Cache;

use App\Models\ProjectUser;
use App\Models\ResourceUser;
use App\Models\User;
use App\Services\Interfaces\CacheServiceInterface;
use App\Services\Users\Repositories\EloquentUserRepository;

/**
 * Class CacheGroupsService
 * Сервис для работы с кэшем пользователя
 *
 * @package App\Services\Users
 */
class UsersCacheService implements CacheServiceInterface
{

    public function clear():void
    {
        User::flushCache(EloquentUserRepository::CACHE_TAG);
        ResourceUser::flushCache();
        ProjectUser::flushCache();
    }

    public function warm():void
    {
        User::get();
    }
}
