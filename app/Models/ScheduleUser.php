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

    public const STATUS_NAME_PENDING = 'PENDING';
    public const STATUS_NAME_CANCEL = 'CANCEL';
    public const STATUS_NAME_CONFIRM = 'CONFIRM';
    public const STATUS_NAME_NOT_VISITED = 'NOT_VISITED';
    public const STATUS_NAME_VISITED = 'VISITED';

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

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_NAME_PENDING => self::STATUS_PENDING,
            self::STATUS_NAME_CANCEL => self::STATUS_CANCEL,
            self::STATUS_NAME_CONFIRM => self::STATUS_CONFIRM,
            self::STATUS_NAME_NOT_VISITED => self::STATUS_NOT_VISITED,
            self::STATUS_NAME_VISITED => self::STATUS_VISITED,
        ];
    }
}
