<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Adv
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $place
 * @property string|null $picture
 * @property int|null $price
 * @property int $status 0-prepare, 1-public, 2-closed
 * @property int $type_adv 1-providing, 2-looking
 * @property int $user_id
 * @property int|null $price_type_id
 * @property int|null $city_id
 * @property int|null $section_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Adv newModelQuery()
 * @method static Builder|Adv newQuery()
 * @method static Builder|Adv query()
 * @method static Builder|Adv whereCityId($value)
 * @method static Builder|Adv whereCreatedAt($value)
 * @method static Builder|Adv whereDescription($value)
 * @method static Builder|Adv whereId($value)
 * @method static Builder|Adv whereName($value)
 * @method static Builder|Adv wherePicture($value)
 * @method static Builder|Adv wherePlace($value)
 * @method static Builder|Adv wherePrice($value)
 * @method static Builder|Adv wherePriceTypeId($value)
 * @method static Builder|Adv whereSectionId($value)
 * @method static Builder|Adv whereSlug($value)
 * @method static Builder|Adv whereStatus($value)
 * @method static Builder|Adv whereTypeAdv($value)
 * @method static Builder|Adv whereUpdatedAt($value)
 * @method static Builder|Adv whereUserId($value)
 * @mixin Eloquent
 */
class Adv extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 20;
    const STATUS_CLOSED = 30;

    const TYPE_LOOKING = 10;
    const TYPE_PROVIDING = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'place',
        'picture',
        'price',
        'status',
        'type_adv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function priceType()
    {
        return $this->belongsTo(PriceType::class);
    }
}
