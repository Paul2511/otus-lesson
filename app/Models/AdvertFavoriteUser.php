<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\AdvertFavoriteUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertFavoriteUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertFavoriteUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertFavoriteUser query()
 * @mixin \Eloquent
 */
class AdvertFavoriteUser extends Pivot
{
    use HasFactory;
}
