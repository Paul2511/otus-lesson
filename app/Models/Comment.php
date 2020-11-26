<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Comment
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Comment extends BaseModel
{
    public const STATUS_PENDING = 10;
    public const STATUS_CANCEL = 20;
    public const STATUS_PUBLIC = 30;

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_CANCEL,
        self::STATUS_PUBLIC,
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'text',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'text' => 'string',
        'status' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
