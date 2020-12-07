<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\Answer
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $question_id
 * @property int $correct
 * @property int|null $type
 * @property string|null $text
 * @property array|null $pictures
 * @property-read \App\Models\Question $question
 * @method static Builder|Answer newModelQuery()
 * @method static Builder|Answer newQuery()
 * @method static Builder|Answer query()
 * @method static Builder|Answer whereCorrect($value)
 * @method static Builder|Answer whereCreatedAt($value)
 * @method static Builder|Answer whereId($value)
 * @method static Builder|Answer wherePictures($value)
 * @method static Builder|Answer whereQuestionId($value)
 * @method static Builder|Answer whereText($value)
 * @method static Builder|Answer whereType($value)
 * @method static Builder|Answer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
