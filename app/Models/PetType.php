<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Skachinsky\LocaleTranslator\LocaleTranslator;
/**
 * App\Models\PetType
 *
 * @property int $id
 * @property string $slug
 * @method static Builder|PetType newModelQuery()
 * @method static Builder|PetType newQuery()
 * @method static Builder|PetType query()
 * @method static Builder|PetType whereId($value)
 * @method static Builder|PetType whereSlug($value)
 * @method static Builder|PetType whereTitle($value)
 * @property string $title
 * @mixin \Eloquent
 *
 * @property-read Collection|Pet[] $pets
 */
class PetType extends BaseModel
{
    use HasFactory;
    use LocaleTranslator;

    public $timestamps = false;

    protected $fillable = [
        'slug'
    ];

    protected $appends = [
        'title'
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function getTitleAttribute() {
        return $this->translateAttribute($this->slug);
    }
}
