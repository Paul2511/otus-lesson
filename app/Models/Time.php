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

    public const STATUS_NAME_INACTIVE = 'INACTIVE';
    public const STATUS_NAME_ACTIVE = 'ACTIVE';

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
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'time_id');
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
