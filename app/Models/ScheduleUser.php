<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ScheduleUser
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $schedule_id
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ScheduleUser extends BaseModel
{
    public const STATUS_PENDING = 10;
    public const STATUS_CANCEL = 20;
    public const STATUS_CONFIRM = 30;
    public const STATUS_NOT_VISITED = 40;
    public const STATUS_VISITED = 50;

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_CANCEL,
        self::STATUS_CONFIRM,
        self::STATUS_NOT_VISITED,
        self::STATUS_VISITED,
    ];

    protected $table = 'schedule_user';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'schedule_id',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'schedule_id' => 'integer',
        'status' => 'integer',
    ];
}
