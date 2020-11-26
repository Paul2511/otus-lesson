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

    public const STATUSES = [
        self::STATUS_INACTIVE,
        self::STATUS_ACTIVE,
    ];

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
        'title' => 'string',
        'status' => 'integer',
    ];

    /**
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'section_id');
    }
}
