<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Restaurant extends Model
{

    protected $fillable = [
        'name',
        'rating',
        'sort',
        'description',
        'meta_title',
        'meta_description',
    ];

    /**
     * @return BelongsTo
     */
    public function comments(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
