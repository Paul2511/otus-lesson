<?php

namespace App\Models;

use App\Casts\Phone;
use App\Helpers\UtilsHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Lead
 *
 * @property int $id
 * @property string|null $type
 * @property int $status
 * @property string|null $internal_phone
 * @property string|null $external_phone
 * @property int $user_id
 * @property int|null $manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Lead newModelQuery()
 * @method static Builder|Lead newQuery()
 * @method static Builder|Lead query()
 * @method static Builder|Lead whereCreatedAt($value)
 * @method static Builder|Lead whereExternalPhone($value)
 * @method static Builder|Lead whereId($value)
 * @method static Builder|Lead whereInternalPhone($value)
 * @method static Builder|Lead whereManagerId($value)
 * @method static Builder|Lead whereStatus($value)
 * @method static Builder|Lead whereType($value)
 * @method static Builder|Lead whereUpdatedAt($value)
 * @method static Builder|Lead whereUserId($value)
 * @mixin \Eloquent
 *
 * @property-read Collection|User   $user
 * @property-read Collection|User   $manager
 *
 */
class Lead extends BaseModel
{
    use HasFactory;

    const TYPE_SITE_REQUEST = 'site_request';
    const TYPE_INCOMING_CALL = 'incoming_call';
    const TYPE_OUTGOING_CALL = 'outgoing_call';

    const STATUS_UNSORTED = 0;
    const STATUS_NEED_CALLBACK = 10;
    const STATUS_REPEATED = 20;
    const STATUS_MEET_HOUSE = 30;
    const STATUS_MEET_CLINIC = 40;
    const STATUS_CHANGE_MEET = 50;
    const STATUS_CANCEL_MEET = 60;
    const STATUS_SPEC = 70;

    /**
     * @var array
     */
    private static $typeLabels;

    /**
     * @var array
     */
    private static $statusLabels;

    public $commentType = 'lead';

    protected $fillable = [
        'type', 'status', 'internal_phone', 'external_phone', 'user_id', 'manager_id'
    ];

    protected $casts = [
        'internal_phone' => Phone::class,
        'external_phone' => Phone::class
    ];

    protected $appends = [
        'internalPhoneFormat', 'externalPhoneFormat'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id')->withDefault();
    }


    public function getInternalPhoneFormatAttribute()
    {
        return Phone::formatPhone($this->attributes['internal_phone']);
    }

    public function getExternalPhoneFormatAttribute()
    {
        return Phone::formatPhone($this->attributes['external_phone']);
    }

    /**
     * @return array
     */
    public static function typeLabels()
    {
        if (isset(self::$typeLabels)) return self::$typeLabels;
        return self::$typeLabels = UtilsHelper::getLangLabels(static::class, 'type');
    }

    /**
     * @return array
     */
    public static function statusLabels()
    {
        if (isset(self::$statusLabels)) return self::$statusLabels;
        return self::$statusLabels = UtilsHelper::getLangLabels(static::class, 'status');
    }

}