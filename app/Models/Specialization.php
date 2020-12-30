<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Specialization
 *
 * @property int $id
 * @property string $slug
 * @property string $title_ru
 * @property string $title_en
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
class Specialization extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title_ru', 'title_en'
    ];

    protected $appends = [
        'title'
    ];

    public function userDetails()
    {
        return $this->hasMany(UserDetail::class);
    }

    public function getTitleAttribute() {
        return $this->translateAttribute('title', $this->slug);
    }
}
