<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Card
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property int $count_month
 * @property int $count_day
 * @property int $price
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Card extends BaseModel
{
    public const STATUS_INACTIVE = 10;
    public const STATUS_ACTIVE = 20;

    public const STATUS_NAME_INACTIVE = 'INACTIVE';
    public const STATUS_NAME_ACTIVE = 'ACTIVE';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'count_month',
        'count_day',
        'price',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'count_month' => 'integer',
        'count_day' => 'integer',
        'price' => 'integer',
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
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'card_user');
    }

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_NAME_INACTIVE => self::STATUS_INACTIVE,
            self::STATUS_NAME_ACTIVE => self::STATUS_ACTIVE,
        ];
    }
}
