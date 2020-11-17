<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\RoomUser
 *
 * @property string $room_id
 * @property string $user_id
 * @property string $message_first_id
 * @property string $message_read_id
 * @property string $message_last_id
 * @property int $is_owner
 * @property int $muted
 * @property int $ban
 * @property \Illuminate\Support\Carbon|null $joined_at
 * @property-read \App\Models\Message $firstMessage
 * @property-read \App\Models\Message $lastMessage
 * @property-read \App\Models\Message $readMessage
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereBan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereIsOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereJoinedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereMessageFirstId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereMessageLastId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereMessageReadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereMuted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereUserId($value)
 * @mixin \Eloquent
 */
class RoomUser extends BasePivot
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'user_id',
        'message_first_id',
        'message_read_id',
        'message_last_id',
        'is_owner',
        'muted',
    ];

    /**
     * Поля с приведением к нативным типам
     *
     * @var array
     */
    protected $casts = [
        'joined_at' => 'datetime',
    ];

    /**
     * Получить комнату участника чата
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Получить пользователя участника чата
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получить первое доступное сообщение участника чата
     */
    public function firstMessage()
    {
        return $this->belongsTo(Message::class, 'message_first_id');
    }

    /**
     * Получить последнее прочтенное сообщение участника чата
     */
    public function readMessage()
    {
        return $this->belongsTo(Message::class, 'message_read_id');
    }

    /**
     * Получить последнее оставленное сообщение участника чата
     */
    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'message_last_id');
    }


}
