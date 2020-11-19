<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Sms
 *
 * @property string $id
 * @property string $user_id
 * @property string $text
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $send_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Sms newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sms newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sms query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $ip_address
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereIpAddress($value)
 */
class Sms extends BaseModel
{
    use HasFactory, UseUuid;

    const STATUS_NEW = 10;
    const STATUS_SENT = 20;
    const STATUS_FAILED = 30;
    const STATUS_CANCELED = 40;

    public $timestamps = false;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ip_address',
        'text',
        'status',
        'send_at',
    ];

    /**
     * Поля с приведением к нативным типам
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'send_at' => 'datetime',
    ];

    /**
     * Список доступных статусов сущности
     *
     * @return array
     */
    public static function getStatuses() {
        return [
            self::STATUS_NEW,
            self::STATUS_SENT,
            self::STATUS_FAILED,
            self::STATUS_CANCELED,
        ];
    }

    /**
     * Получить пользователя вызвавшего событие
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
