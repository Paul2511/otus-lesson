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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
