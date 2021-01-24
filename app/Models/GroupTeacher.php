<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

/**
 * App\Models\GroupTeacher
 *
 * @property int $id
 * @property int $group_id
 * @property int $teacher_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder|GroupTeacher newModelQuery()
 * @method static Builder|GroupTeacher newQuery()
 * @method static Builder|GroupTeacher query()
 * @method static Builder|GroupTeacher whereCreatedAt($value)
 * @method static Builder|GroupTeacher whereGroupId($value)
 * @method static Builder|GroupTeacher whereId($value)
 * @method static Builder|GroupTeacher whereTeacherId($value)
 * @method static Builder|GroupTeacher whereUpdatedAt($value)
 * @mixin Eloquent
 */
class GroupTeacher extends Pivot
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
