<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Advert
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $price
 * @property string $address
 * @property int $status
 * @property int $is_premium
 * @property int $region_id
 * @property int $user_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $category
 * @property-read int|null $category_count
 * @property-read \App\Models\Region $region
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Advert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert query()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereIsPremium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $favorites
 * @property-read int|null $favorites_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdvertImage[] $image
 * @property-read int|null $image_count
 */
class Advert extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    const STATUS_DEFAULT = 0;
    const STATUS_PREMIUM = 10;


    protected $fillable = [
        'title',
        'slug',
        'price',
        'description',
        'address',
        'status',
        'premium',
        'region_id',
        'user_id',
        'category_id',
    ];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AdvertImage::class);
    }

    public function favorites(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'advert_favorites', 'advert_id', 'user_id')->using(AdvertFavourite::class);
    }
}
