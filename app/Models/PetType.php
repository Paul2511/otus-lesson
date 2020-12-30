<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
/**
 * App\Models\PetType
 *
 * @property int $id
 * @property string $slug
 * @property string $title_ru
 * @property string $title_en
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

    protected $fillable = [
        'slug', 'title_ru', 'title_en'
    ];

    protected $appends = [
        'title'
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function getTitleAttribute() {
        return $this->translateAttribute('title', $this->slug);
    }
}
