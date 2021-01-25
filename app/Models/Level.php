<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Level
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder|Level newModelQuery()
 * @method static Builder|Level newQuery()
 * @method static Builder|Level query()
 * @method static Builder|Level whereCreatedAt($value)
 * @method static Builder|Level whereId($value)
 * @method static Builder|Level whereOrder($value)
 * @method static Builder|Level whereSlug($value)
 * @method static Builder|Level whereTitle($value)
 * @method static Builder|Level whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Level extends BaseModel
{
    protected $fillable = [
        'title',
        'slug',
        'order'
    ];
}
