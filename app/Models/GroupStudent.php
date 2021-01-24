<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

/**
 * App\Models\GroupStudent
 *
 * @property int $id
 * @property int $group_id
 * @property int $student_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder|GroupStudent newModelQuery()
 * @method static Builder|GroupStudent newQuery()
 * @method static Builder|GroupStudent query()
 * @method static Builder|GroupStudent whereCreatedAt($value)
 * @method static Builder|GroupStudent whereGroupId($value)
 * @method static Builder|GroupStudent whereId($value)
 * @method static Builder|GroupStudent whereStudentId($value)
 * @method static Builder|GroupStudent whereUpdatedAt($value)
 * @mixin Eloquent
 */
class GroupStudent extends Pivot
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
