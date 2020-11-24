<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * App\Models\Question
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $survey_id
 * @property string                          $name
 * @property string                          $type
 * @property string|null                     $text
 * @property array|null                      $pictures
 * @property-read \App\Models\Survey         $survey
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question wherePictures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereSurveyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Question extends BaseModel
{
    const TYPE_CHECKBOX = 10;
    const TYPE_RADIO    = 20;

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
