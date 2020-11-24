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

    public const STATUS_NAME_PENDING = 'PENDING';
    public const STATUS_NAME_INACTIVE = 'INACTIVE';
    public const STATUS_NAME_EXPIRED = 'EXPIRED';
    public const STATUS_NAME_CANCEL = 'CANCEL';
    public const STATUS_NAME_ACTIVE = 'ACTIVE';

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
        'start' => 'Carbon',
        'end' => 'Carbon',
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
            self::STATUS_NAME_INACTIVE => self::STATUS_INACTIVE,
            self::STATUS_NAME_EXPIRED => self::STATUS_EXPIRED,
            self::STATUS_NAME_CANCEL => self::STATUS_CANCEL,
            self::STATUS_NAME_ACTIVE => self::STATUS_ACTIVE,
        ];
    }
}
