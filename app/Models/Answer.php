<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Answer extends BaseModel
{
    const TYPE_TEXT    = 10;
    const TYPE_PICTURE = 20;

    protected $fillable = ['correct', 'type', 'text', 'pictures'];

    protected $casts = ['pictures' => 'array'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
