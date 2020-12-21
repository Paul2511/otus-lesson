<?php


namespace App\Services\Queues\Repositories;

use App\Models\Queue;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EloquentQueueRepository
{
    public function getList($connection): array
    {
        return Queue::on($connection)
            ->get()->keyBy('name')->toArray();
    }
}
