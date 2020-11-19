<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Message
 *
 * @property string $id
 * @property string $room_id
 * @property string $creator_id
 * @property int $status
 * @property string $text_view
 * @property string $text_raw
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\Room $room
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereTextRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereTextView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Message extends BaseModel
{
    use HasFactory, UseUuid;

    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 20;
    const STATUS_DELETED_BY_OWNER = 30;
    const STATUS_DELETED_BY_ADMIN = 40;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'creator_id',
        'status',
        'text_view',
        'text_raw',
    ];

    /**
     * Получить создателя сообщения
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Получить комнату сообщения
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

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

}
