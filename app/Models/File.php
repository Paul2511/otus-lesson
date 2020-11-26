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
