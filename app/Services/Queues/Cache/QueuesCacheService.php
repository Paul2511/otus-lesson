<?php

namespace App\Services\Queues\Cache;

use App\Models\Queue;
use App\Services\Interfaces\CacheServiceInterface;
use App\Services\Queues\QueuesService;

/**
 * Class CacheGroupsService
 * Сервис для работы с кэшем проектов
 *
 * @package App\Services\Queue
 */
class QueuesCacheService implements CacheServiceInterface
{

    public function clear():void
    {
        Queue::flushCache();
    }

    public function warm():void
    {
        foreach (QueuesService::CONNECTION as $connection) {
            Queue::on($connection)->get()->keyBy('name')->toArray();
        }
    }
}
