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
 * @property string $title
 * @method static Builder|Specialization newModelQuery()
 * @method static Builder|Specialization newQuery()
 * @method static Builder|Specialization query()
 * @method static Builder|Specialization whereId($value)
 * @method static Builder|Specialization whereSlug($value)
 * @mixin \Eloquent
 *
 * @property-read Collection|UserDetail[] $userDetails
 */
class Specialization extends BaseModel
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'slug'
    ];

    protected $appends = [
        'title'
    ];

    public $translateType = Translate::TYPE_SPECIALIZATION;

    public function userDetails()
    {
        return $this->hasMany(UserDetail::class);
    }

    public function getTitleAttribute() {
        return $this->translateAttribute($this->slug);
    }
}
