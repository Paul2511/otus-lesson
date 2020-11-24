<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Schedule
 * @package App\Models
 *
 * @property int $id
 * @property Carbon $date
 * @property int $time_id
 * @property int $user_id
 * @property int $section_id
 * @property int $gym_id
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Schedule extends BaseModel
{
    public const STATUS_INACTIVE = 10;
    public const STATUS_ACTIVE = 20;

    public const STATUS_NAME_INACTIVE = 'INACTIVE';
    public const STATUS_NAME_ACTIVE = 'ACTIVE';

    /**
     * @var array
     */
    protected $fillable = [
        'date',
        'time_id',
        'user_id',
        'section_id',
        'gym_id',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'date' => 'Carbon',
        'time_id' => 'integer',
        'user_id' => 'integer',
        'section_id' => 'integer',
        'gym_id' => 'integer',
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
     * записи гостя
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'schedule_user');
    }

    /**
     * записи трененра
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function time(): BelongsTo
    {
        return $this->belongsTo(Time::class, 'time_id');
    }

    /**
     * @return BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * @return BelongsTo
     */
    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class, 'gym_id');
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
