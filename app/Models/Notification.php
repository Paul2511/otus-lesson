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
    public const GUEST_SIGN_UP = 10;
    public const GUEST_VERIFIED = 20;
    public const GUEST_CHECK_SCHEDULE = 30;
    public const GUEST_CHECK_CARD = 40;
    public const GUEST_ADD_COMMENT = 50;
    public const GUEST_ADD_MESSAGE = 60;

    public const ADMIN_CHECK_SCHEDULE = 70;
    public const ADMIN_CHECK_CARD = 80;
    public const ADMIN_CHECK_COMMENT = 90;
    public const ADMIN_ADD_MESSAGE = 100;

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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'notification_user');
    }
}
