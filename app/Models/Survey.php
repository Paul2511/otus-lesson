<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;


/**
 * App\Models\Survey
 *
 * @property int                             $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string                          $name
 * @property string|null                     $text
 * @property string|null                     $picture
 * @property-read Collection|Question[]      $questions
 * @property-read int|null                   $questions_count
 * @method static Builder|Survey newModelQuery()
 * @method static Builder|Survey newQuery()
 * @method static Builder|Survey query()
 * @method static Builder|Survey whereCreatedAt($value)
 * @method static Builder|Survey whereId($value)
 * @method static Builder|Survey whereName($value)
 * @method static Builder|Survey wherePicture($value)
 * @method static Builder|Survey whereText($value)
 * @method static Builder|Survey whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Survey extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'text', 'picture'];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
