<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Watson\Rememberable\Rememberable;


/**
 * App\Models\Question
 *
 * @property int                      $id
 * @property Carbon|null              $created_at
 * @property Carbon|null              $updated_at
 * @property int                      $survey_id
 * @property string                   $name
 * @property string                   $type
 * @property string|null              $text
 * @property array|null               $pictures
 * @property-read Survey              $survey
 * @method static Builder|Question newModelQuery()
 * @method static Builder|Question newQuery()
 * @method static Builder|Question query()
 * @method static Builder|Question whereCreatedAt($value)
 * @method static Builder|Question whereId($value)
 * @method static Builder|Question whereName($value)
 * @method static Builder|Question wherePictures($value)
 * @method static Builder|Question whereSurveyId($value)
 * @method static Builder|Question whereText($value)
 * @method static Builder|Question whereType($value)
 * @method static Builder|Question whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Collection|Answer[] $answer
 * @property-read int|null            $answer_count
 */
class Question extends BaseModel
{
    use Rememberable;

    public const TYPE_CHECKBOX = 10;
    public const TYPE_RADIO = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'text', 'pictures', 'type'];

    protected $casts = ['pictures' => 'array'];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    public function answer(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
