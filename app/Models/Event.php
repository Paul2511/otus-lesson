<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Event
 *
 * @property string $id
 * @property string $user_id
 * @property string $type
 * @property string $slug
 * @property int $level
 * @property string $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 * @mixin \Eloquent
 */
class Event extends BaseModel
{
    use HasFactory, UseUuid;

    public $timestamps = false;

    const TYPE_SYSTEM = 10;
    const TYPE_USER = 20;
    const TYPE_SMS = 30;
    const TYPE_POST = 40;

    const LEVEL_INFO = 10;
    const LEVEL_WARNING = 20;
    const LEVEL_CRITICAL = 30;

    const SLUG_DEFAULT = 'DEFAULT';

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ip_address',
        'type',
        'slug',
        'level',
        'data',
    ];

    /**
     * Поля с приведением к нативным типам
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Получить пользователя вызвавшего событие
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
