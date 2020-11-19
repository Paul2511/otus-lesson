<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Tag
 *
 * @property string $id
 * @property string $slug
 * @property int $priority
 * @property string $name
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends BaseModel
{
    use HasFactory, UseUuid;

    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 20;
    const STATUS_DELETED = 30;

    public $timestamps = false;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'priority',
        'name',
        'status',
    ];

    /**
     * Список доступных статусов сущности
     *
     * @return array
     */
    public static function getStatuses() {
        return [
            self::STATUS_INACTIVE,
            self::STATUS_ACTIVE,
            self::STATUS_DELETED,
        ];
    }

}
