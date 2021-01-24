<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

/**
 * App\Models\GroupSize
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $max_count
 * @property int $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Group[] $groups
 * @method static Builder|GroupSize newModelQuery()
 * @method static Builder|GroupSize newQuery()
 * @method static Builder|GroupSize query()
 * @method static Builder|GroupSize whereCreatedAt($value)
 * @method static Builder|GroupSize whereId($value)
 * @method static Builder|GroupSize whereMaxCount($value)
 * @method static Builder|GroupSize whereOrder($value)
 * @method static Builder|GroupSize whereSlug($value)
 * @method static Builder|GroupSize whereTitle($value)
 * @method static Builder|GroupSize whereUpdatedAt($value)
 * @mixin Eloquent
 */
class GroupSize extends BaseModel
{

    protected $fillable = [
        'title',
        'slug',
        'max_count',
        'order'
    ];

    /**
     * Get all of the students for the group.
     */
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
