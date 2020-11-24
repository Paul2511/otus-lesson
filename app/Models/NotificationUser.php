<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationUser
 * @package App\Models
 *
 * @property int $id
 * @property int $notification_id
 * @property int $user_id
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class NotificationUser extends BaseModel
{
    public const STATUS_READY = 10;
    public const STATUS_SENT = 20;
    public const STATUS_ERROR = 30;

    public const STATUS_NAME_READY = 'READY';
    public const STATUS_NAME_SENT = 'SENT';
    public const STATUS_NAME_ERROR = 'ERROR';

    protected $table = 'notification_user';

    /**
     * @var array
     */
    protected $fillable = [
        'notification_id',
        'user_id',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'notification_id' => 'integer',
        'user_id' => 'integer',
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
            self::STATUS_NAME_READY => self::STATUS_READY,
            self::STATUS_NAME_SENT => self::STATUS_SENT,
            self::STATUS_NAME_ERROR => self::STATUS_ERROR,
        ];
    }
}
