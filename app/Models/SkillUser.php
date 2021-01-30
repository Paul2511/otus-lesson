<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

/**
 * App\Models\SkillUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $skill_id
 * @property int $level_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder|SkillUser newModelQuery()
 * @method static Builder|SkillUser newQuery()
 * @method static Builder|SkillUser query()
 * @method static Builder|SkillUser whereCreatedAt($value)
 * @method static Builder|SkillUser whereId($value)
 * @method static Builder|SkillUser whereLevelId($value)
 * @method static Builder|SkillUser whereSkillId($value)
 * @method static Builder|SkillUser whereUpdatedAt($value)
 * @method static Builder|SkillUser whereUserId($value)
 * @mixin Eloquent
 */
class SkillUser extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'skill_id', 'level_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
}
