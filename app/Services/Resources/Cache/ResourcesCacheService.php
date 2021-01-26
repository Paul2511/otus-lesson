<?php

namespace App\Services\Resources\Cache;

use App\Models\Resource;
use App\Services\Interfaces\CacheServiceInterface;

/**
 * Class CacheGroupsService
 * Сервис для работы с кэшем ресурсов
 *
 * @package App\Services\Resource
 */
class ResourcesCacheService implements CacheServiceInterface
{

    public function clear():void
    {
        Resource::flushCache();
    }

    public function warm():void
    {
        Resource::whereIsActive(1)->get()->keyBy('id');
    }
}
