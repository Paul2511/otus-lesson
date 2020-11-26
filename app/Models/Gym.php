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

    public const STATUSES = [
        self::STATUS_INACTIVE,
        self::STATUS_ACTIVE,
    ];

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
        'title' => 'string',
        'number' => 'integer',
        'status' => 'integer',
    ];

    /**
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'gym_id');
    }
}
