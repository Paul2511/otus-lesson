<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Room
 *
 * @property string $id
 * @property string $title
 * @property string $creator_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Room extends BaseModel
{
    use HasFactory, UseUuid;

    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 30;
    const STATUS_DELETED_BY_OWNER = 50;
    const STATUS_DELETED_BY_ADMIN = 60;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'creator_id',
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
            self::STATUS_DELETED_BY_OWNER,
            self::STATUS_DELETED_BY_ADMIN,
        ];
    }

    /**
     * Получить пользователей чата
     */
    public function users()
    {
        return $this
            ->belongsToMany(User::class)
            ->using(RoomUser::class);
    }

    /**
     * Получить создателя чата
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
