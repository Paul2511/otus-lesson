<?php

namespace App\Models;

use App\Models\Traits\UserTimezoneTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Watson\Rememberable\Rememberable;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $type
 * @property int $row_id
 * @property int $user_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereBody($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereRowId($value)
 * @method static Builder|Comment whereType($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment whereUserId($value)
 * @mixin \Eloquent
 *
 * @property-read Collection|User   $user
 */
class Comment extends Model
{
    use HasFactory, UserTimezoneTrait, Rememberable;

    protected $rememberCachePrefix = 'comments';

    protected $fillable = [
        'type', 'body', 'row_id', 'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:i'
    ];

    protected $appends = [
        'formatCreatedAt'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatCreatedAtAttribute(): string
    {
        return $this->created_at ? $this->asDateTime($this->created_at) : null;
    }

}
