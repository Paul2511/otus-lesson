<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Gym
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property int $number
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Gym extends BaseModel
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
        'number',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'title' => 'time',
        'number' => 'integer',
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
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'gym_id');
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
