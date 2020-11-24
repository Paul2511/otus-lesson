<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Section
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Section extends BaseModel
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
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'title' => 'time',
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
        return $this->hasMany(Schedule::class, 'section_id');
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
