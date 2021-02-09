<?php


namespace App\Models;


class ModQueueStatus extends BaseModel
{
    protected $connection = 'qsiq';

    protected $table = 'mod_queue_status';

    protected $primaryKey = 'id';
}
