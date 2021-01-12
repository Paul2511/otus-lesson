<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Region
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $parent_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Advert|null $region
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Advert[] $adverts
 * @property-read int|null $adverts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Region[] $city
 * @property-read int|null $city_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Region[] $children
 * @property-read int|null $children_count
 */
class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
    ];

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function adverts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Advert::class);
    }


    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Region::class, 'parent_id');
    }
}
