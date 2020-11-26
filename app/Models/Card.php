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

    public const STATUSES = [
        self::STATUS_INACTIVE,
        self::STATUS_ACTIVE,
    ];

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
        'price' => 'decimal:2',
        'status' => 'integer',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'card_user');
    }
}
