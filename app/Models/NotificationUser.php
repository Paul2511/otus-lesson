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

    public const STATUSES = [
        self::STATUS_READY,
        self::STATUS_SENT,
        self::STATUS_ERROR,
    ];

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
}
