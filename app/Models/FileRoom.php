<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\FileRoom
 *
 * @property string $id
 * @property string $file_id
 * @property string $room_id
 * @property string $message_id
 * @property string $creator_id
 * @property int $status
 * @property string|null $created_at
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\File $file
 * @property-read \App\Models\Message $message
 * @property-read \App\Models\Room $room
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileRoom whereStatus($value)
 * @mixin \Eloquent
 */
class FileRoom extends BasePivot
{
    use HasFactory, UseUuid;

    public $timestamps = false;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'file_id',
        'room_id',
        'message_id',
        'creator_id',
        'status',
        'data',
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
     * Получить создателя вложения
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Получить файл вложения
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    /**
     * Получить комнату вложения
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Получить сообщение вложения
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }

}
