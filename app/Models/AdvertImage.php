<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdvertImage
 *
 * @property int $id
 * @property string $thumbnail
 * @property int $advert_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Advert[] $adverts
 * @property-read int|null $adverts_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdvertImage extends Model
{
    use HasFactory;

    protected $fillable = ['thumbnail', 'advert_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function adverts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Advert::class);
    }
}
