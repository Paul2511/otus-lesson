<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Specialization
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @method static Builder|Specialization newModelQuery()
 * @method static Builder|Specialization newQuery()
 * @method static Builder|Specialization query()
 * @method static Builder|Specialization whereId($value)
 * @method static Builder|Specialization whereSlug($value)
 * @method static Builder|Specialization whereTitle($value)
 * @mixin \Eloquent
 *
 * @property-read Collection|UserDetail[] $userDetails
 */
class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title'
    ];

    public function userDetails()
    {
        return $this->hasMany(UserDetail::class);
    }
}
