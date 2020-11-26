<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Time
 * @package App\Models
 *
 * @property int $id
 * @property Carbon $start
 * @property Carbon $end
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Time extends BaseModel
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
        'start',
        'end',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => 'integer',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'start',
        'end',
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'time_id');
    }
}
