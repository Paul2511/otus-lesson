<?php

namespace App\Services\Queues;

use App\Services\Queues\Repositories\EloquentQueueRepository;

class QueuesService
{
    private EloquentQueueRepository $eloquentQueueRepository;

    const CONNECTION
        = array(
            'qsiq' ,
            'qsiqkz',
            'sod',
            'sod3',
        );


    public function __construct(
        EloquentQueueRepository $eloquentQueueRepository
    ) {
        $this->eloquentQueueRepository = $eloquentQueueRepository;
    }


    public function getAllQueues(): array
    {
        $queues = [];
        foreach (self::CONNECTION as $connection) {
            $queues += $this->eloquentQueueRepository->getList($connection);
        }
        return $queues;
    }

}
