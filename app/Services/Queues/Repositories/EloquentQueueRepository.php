<?php


namespace App\Services\Queues\Repositories;

use App\Models\Queue;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EloquentQueueRepository
{
    const CACHE_TTL = 60*60*24;
    const CACHE_TAG = 'queues';

    public function getList($connection): array
    {
        return Queue::on($connection)->remember(self::CACHE_TTL)->cacheTags(self::CACHE_TAG)
            ->get()->keyBy('name')->toArray();
    }
}
