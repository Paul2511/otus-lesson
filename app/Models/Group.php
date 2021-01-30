<?php

namespace App\Models;

use \Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Group
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $is_active
 * @property int $size_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read GroupSize $size
 * @property-read Collection|User[] $students
 * @property-read int|null $students_count
 * @property-read Collection|User[] $teachers
 * @property-read int|null $teachers_count
 * @method static Builder|Group newModelQuery()
 * @method static Builder|Group newQuery()
 * @method static Builder|Group query()
 * @method static Builder|Group whereCreatedAt($value)
 * @method static Builder|Group whereDescription($value)
 * @method static Builder|Group whereId($value)
 * @method static Builder|Group whereIsActive($value)
 * @method static Builder|Group whereSizeId($value)
 * @method static Builder|Group whereSlug($value)
 * @method static Builder|Group whereTitle($value)
 * @method static Builder|Group whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Group extends BaseModel
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_active',
        'size_id',
    ];

    /**
     * Get size for the group.
     */
    public function size(): belongsTo
    {
        return $this->belongsTo(GroupSize::class);
    }

    /**
     * Get all of the students for the group.
     */
    public function students(): belongsToMany
    {
        return $this->belongsToMany(User::class, GroupStudent::class, 'group_id', 'student_id')->withPivot('id');
    }

    /**
     * Get all of the teachers for the group.
     */
    public function teachers(): belongsToMany
    {
        return $this->belongsToMany(User::class, GroupTeacher::class, 'group_id', 'teacher_id')->withPivot('id');
    }
}
