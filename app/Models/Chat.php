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

    public const STATUSES = [
        self::STATUS_INACTIVE,
        self::STATUS_ACTIVE,
    ];

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
        'user_id' => 'integer',
        'status' => 'integer',
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
}
