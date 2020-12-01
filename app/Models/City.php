<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\City
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|City newModelQuery()
 * @method static Builder|City newQuery()
 * @method static Builder|City query()
 * @method static Builder|City whereCountryId($value)
 * @method static Builder|City whereCreatedAt($value)
 * @method static Builder|City whereId($value)
 * @method static Builder|City whereName($value)
 * @method static Builder|City whereSlug($value)
 * @method static Builder|City whereUpdatedAt($value)
 * @mixin Eloquent
 */
class City extends Model
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
        'slug',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function advs()
    {
        return $this->hasMany(Adv::class);
    }

    public function activeAdvs()
    {
        return $this->advs()
            ->where('status', Adv::STATUS_ACTIVE);
    }
}
