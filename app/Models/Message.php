<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Message
 * @package App\Models
 *
 * @property int $id
 * @property int $chat_id
 * @property int $user_id
 * @property string $title
 * @property string $text
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Message extends BaseModel
{
    public const STATUS_UNREAD = 10;
    public const STATUS_READ = 10;

    /**
     * @var array
     */
    protected $fillable = [
        'chat_id',
        'user_id',
        'title',
        'text',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'chat_id' => 'string',
        'user_id' => 'string',
        'title' => 'string',
        'text' => 'string',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    /**
     * @return BelongsToMany
     */
    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'file_message');
    }
}
