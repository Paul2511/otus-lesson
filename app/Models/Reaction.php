<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Reaction
 *
 * @property string $user_id
 * @property string|null $ip_address
 * @property string $type
 * @property string $entity_type
 * @property string $entity_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereUserId($value)
 * @mixin \Eloquent
 */
class Reaction extends BaseModel
{
    use HasFactory;

    public $timestamps = false;

    const TYPE_LIKE = 10;
    const TYPE_DISLIKE = 20;
    const TYPE_FAVORITE = 30;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ip_address',
        'type',
        'entity_type',
        'entity_id',
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
     * Получить пользователя реакции
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
