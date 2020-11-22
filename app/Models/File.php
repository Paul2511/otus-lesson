<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class File
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $fid
 * @property string $url
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class File extends BaseModel
{
    public const TITLE_AVATAR_DEFAULT = 'avatar_default';
    public const FID_AVATAR_DEFAULT = 'd0976ada-35dd-4005-991f-dd0e915e95ae';
    public const URL_AVATAR_DEFAULT = '/images/guest_avatar_light.png';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'fid',
        'url',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'fid' => 'string',
        'url' => 'string',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'file_id');
    }

    /**
     * @return BelongsToMany
     */
    public function messages(): BelongsToMany
    {
        return $this->belongsToMany(Message::class, 'file_message');
    }
}
