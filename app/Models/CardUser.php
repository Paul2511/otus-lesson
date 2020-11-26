<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class CardUser
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $card_id
 * @property Carbon $start
 * @property Carbon $end
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CardUser extends BaseModel
{
    public const STATUS_PENDING = 10;
    public const STATUS_INACTIVE = 20;
    public const STATUS_EXPIRED = 30;
    public const STATUS_CANCEL = 40;
    public const STATUS_ACTIVE = 50;

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_INACTIVE,
        self::STATUS_EXPIRED,
        self::STATUS_CANCEL,
        self::STATUS_ACTIVE,
    ];

    protected $table = 'card_user';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'card_id',
        'start',
        'end',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'card_id' => 'integer',
        'status' => 'integer',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'start' => 'Carbon',//иначе ошибка, почему?
        'end' => 'Carbon',
        'created_at',
        'updated_at',
    ];
}
