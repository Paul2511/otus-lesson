<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PriceType
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $short_text
 * @property int $country_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PriceType newModelQuery()
 * @method static Builder|PriceType newQuery()
 * @method static Builder|PriceType query()
 * @method static Builder|PriceType whereCode($value)
 * @method static Builder|PriceType whereCountryId($value)
 * @method static Builder|PriceType whereCreatedAt($value)
 * @method static Builder|PriceType whereId($value)
 * @method static Builder|PriceType whereName($value)
 * @method static Builder|PriceType whereShortText($value)
 * @method static Builder|PriceType whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PriceType extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'short_text',
    ];
}
