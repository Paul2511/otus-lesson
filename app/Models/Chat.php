<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Chat
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Chat extends BaseModel
{
    public const STATUS_INACTIVE = 10;
    public const STATUS_ACTIVE = 20;

    public const STATUS_NAME_INACTIVE = 'INACTIVE';
    public const STATUS_NAME_ACTIVE = 'ACTIVE';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'string',
        'status' => 'integer',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'chat_id');
    }

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_NAME_INACTIVE => self::STATUS_INACTIVE,
            self::STATUS_NAME_ACTIVE => self::STATUS_ACTIVE,
        ];
    }
}
