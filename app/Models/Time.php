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
        'start' => 'time',
        'end' => 'time',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'time_id');
    }
}
