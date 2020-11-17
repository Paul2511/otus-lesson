<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Request
 *
 * @property int $id
 * @property int $client_id
 * @property string $type
 * @property int|null $user_id
 * @property int $created_by
 * @property string $body
 * @property int|null $team_id
 * @property string|null $address
 * @property string $date_time
 * @property int $status
 * @property string|null $cancel_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Request newModelQuery()
 * @method static Builder|Request newQuery()
 * @method static Builder|Request query()
 * @method static Builder|Request whereAddress($value)
 * @method static Builder|Request whereBody($value)
 * @method static Builder|Request whereCancelReason($value)
 * @method static Builder|Request whereClientId($value)
 * @method static Builder|Request whereCreatedAt($value)
 * @method static Builder|Request whereCreatedBy($value)
 * @method static Builder|Request whereDateTime($value)
 * @method static Builder|Request whereId($value)
 * @method static Builder|Request whereStatus($value)
 * @method static Builder|Request whereTeamId($value)
 * @method static Builder|Request whereType($value)
 * @method static Builder|Request whereUpdatedAt($value)
 * @method static Builder|Request whereUserId($value)
 * @mixin \Eloquent
 *
 * @property-read Collection|User $client
 * @property-read Collection|User $user
 * @property-read Collection|Team $team
 * @property-read Collection|User $createdBy
 *
 */
class Request extends BaseModel
{
    use HasFactory;

    const TYPE_HOUSE = 'house';
    const TYPE_CLINIC = 'clinic';

    public static $typeLabels = [
        self::TYPE_HOUSE => 'Вызов на дом',
        self::TYPE_CLINIC => 'Посещение клиники'
    ];

    const STATUS_ACTUAL = 10;
    const STATUS_CANCELED = 20;
    const STATUS_FAULT = 30;
    const STATUS_DONE = 40;

    public static $statusLabels = [
        self::STATUS_ACTUAL => 'Актуальная',
        self::STATUS_CANCELED => 'Отменена клиентом',
        self::STATUS_FAULT => 'Отменена специалистом',
        self::STATUS_DONE => 'Выполнена',
    ];

    public $commentType = 'request';

    protected $fillable = [
        'client_id', 'type', 'user_id', 'body', 'team_id', 'address', 'date_time', 'status', 'cancel_reason'
    ];

    protected $casts = [
        'date_time' => 'datetime'
    ];

    /**
     * Клиент, от которого заявка
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Назначенный специалист
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Выбранная клиника
     */
    public function team()
    {
        return $this->belongsTo(Team::class)->withDefault();
    }

    /**
     * Кто создал заявку
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
