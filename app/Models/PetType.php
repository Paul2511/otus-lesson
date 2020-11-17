<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PetType
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @method static Builder|PetType newModelQuery()
 * @method static Builder|PetType newQuery()
 * @method static Builder|PetType query()
 * @method static Builder|PetType whereId($value)
 * @method static Builder|PetType whereSlug($value)
 * @method static Builder|PetType whereTitle($value)
 * @mixin \Eloquent
 *
 * @property-read Collection|Pet[] $pets
 */
class PetType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title'
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
