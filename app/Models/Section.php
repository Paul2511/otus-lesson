<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Section
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int|null $group_id
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Section newModelQuery()
 * @method static Builder|Section newQuery()
 * @method static Builder|Section query()
 * @method static Builder|Section whereCreatedAt($value)
 * @method static Builder|Section whereDescription($value)
 * @method static Builder|Section whereGroupId($value)
 * @method static Builder|Section whereId($value)
 * @method static Builder|Section whereName($value)
 * @method static Builder|Section whereParentId($value)
 * @method static Builder|Section whereSlug($value)
 * @method static Builder|Section whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Section extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function advs()
    {
        return $this->hasMany(Adv::class);
    }

    public function sectionGroups()
    {
        return $this->belongsTo(SectionGroup::class);
    }
}
