<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Notification
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Notification extends BaseModel
{
    // уведомления админу о действиях ползователя
    public const TYPE_GUEST_REGISTER = 10;
    public const TYPE_GUEST_VERIFY = 20;
    public const TYPE_GUEST_CHECK_SCHEDULE = 30;
    public const TYPE_GUEST_CHECK_CARD = 40;
    public const TYPE_GUEST_ADD_COMMENT = 50;
    public const TYPE_GUEST_ADD_MESSAGE = 60;

    public const TYPE_NAME_GUEST_REGISTER = 'GUEST_REGISTER';
    public const TYPE_NAME_GUEST_VERIFY = 'GUEST_VERIFY';
    public const TYPE_NAME_GUEST_CHECK_SCHEDULE = 'GUEST_CHECK_SCHEDULE';
    public const TYPE_NAME_GUEST_CHECK_CARD = 'GUEST_CHECK_CARD';
    public const TYPE_NAME_GUEST_ADD_COMMENT = 'GUEST_ADD_COMMENT';
    public const TYPE_NAME_GUEST_ADD_MESSAGE = 'GUEST_ADD_MESSAGE';

    //уведомления гостю
    public const TYPE_ADMIN_CHECK_SCHEDULE = 70;
    public const TYPE_ADMIN_CHECK_CARD = 80;
    public const TYPE_ADMIN_CHECK_COMMENT = 90;
    public const TYPE_ADMIN_ADD_MESSAGE = 100;
    public const TYPE_NEWS = 200;

    public const TYPE_NAME_ADMIN_CHECK_SCHEDULE = 'ADMIN_CHECK_SCHEDULE';
    public const TYPE_NAME_ADMIN_CHECK_CARD = 'ADMIN_CHECK_CARD';
    public const TYPE_NAME_ADMIN_CHECK_COMMENT = 'ADMIN_CHECK_COMMENT';
    public const TYPE_NAME_ADMIN_ADD_MESSAGE = 'ADMIN_ADD_MESSAGE';
    public const TYPE_NAME_NEWS = 'NEWS';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
        'type',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'text' => 'string',
        'type' => 'integer',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'notification_user');
    }

    /**
     * @return array
     */
    public static function getTypesForGuest(): array
    {
        return [
            self::TYPE_NAME_ADMIN_CHECK_SCHEDULE => self::TYPE_ADMIN_CHECK_SCHEDULE,
            self::TYPE_NAME_ADMIN_CHECK_CARD => self::TYPE_ADMIN_CHECK_CARD,
            self::TYPE_NAME_ADMIN_CHECK_COMMENT => self::TYPE_ADMIN_CHECK_COMMENT,
            self::TYPE_NAME_ADMIN_ADD_MESSAGE => self::TYPE_ADMIN_ADD_MESSAGE,
            self::TYPE_NAME_NEWS => self::TYPE_NEWS,
        ];
    }

    /**
     * @return array
     */
    public static function getTypesForAdmin(): array
    {
        return [
            self::TYPE_NAME_GUEST_REGISTER => self::TYPE_GUEST_REGISTER,
            self::TYPE_NAME_GUEST_VERIFY => self::TYPE_GUEST_VERIFY,
            self::TYPE_NAME_GUEST_CHECK_SCHEDULE => self::TYPE_GUEST_CHECK_SCHEDULE,
            self::TYPE_NAME_GUEST_CHECK_CARD => self::TYPE_GUEST_CHECK_CARD,
            self::TYPE_NAME_GUEST_ADD_COMMENT => self::TYPE_GUEST_ADD_COMMENT,
            self::TYPE_NAME_GUEST_ADD_MESSAGE => self::TYPE_GUEST_ADD_MESSAGE,
        ];
    }
}
