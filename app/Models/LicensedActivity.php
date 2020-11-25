<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * @property integer $id
 * @property integer $country_id
 * @property string $title
 * @property string $code
 * @property Country $country
 * @property Company[] $companies
 */
class LicensedActivity extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['country_id', 'title', 'code'];

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return BelongsToMany
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }
}
