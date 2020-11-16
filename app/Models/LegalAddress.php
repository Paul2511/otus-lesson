<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property integer $company_id
 * @property integer $country_id
 * @property string $administrative_area_level_1
 * @property string $administrative_area_level_2
 * @property string $administrative_area_level_3
 * @property string $locality
 * @property string $route
 * @property string $street
 * @property string $street_number
 * @property string $postal_code
 * @property string $room
 * @property string $raw_address
 * @property float $lat
 * @property float $lng
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property Country $country
 */
class LegalAddress extends Model
{
    use HasFactory;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['company_id', 'country_id', 'administrative_area_level_1', 'administrative_area_level_2', 'administrative_area_level_3', 'locality', 'route', 'street', 'street_number', 'postal_code', 'room', 'raw_address', 'lat', 'lng', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
}
