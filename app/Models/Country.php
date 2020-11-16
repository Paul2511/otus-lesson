<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 * @property string $capital
 * @property mixed $languages
 * @property string $created_at
 * @property string $updated_at
 * @property Company[] $companies
 * @property CvpCode[] $cvpCodes
 * @property FinancialReportCode[] $financialReportCodes
 * @property LegalAddress[] $legalAddresses
 * @property LegalForm[] $legalForms
 * @property LicensedActivity[] $licensedActivities
 * @property UnlicensedActivity[] $unlicensedActivities
 */
class Country extends Model
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
    protected $fillable = ['country_code', 'country_name', 'capital', 'languages', 'created_at', 'updated_at'];


    protected $casts =[
        'languages' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companies()
    {
        return $this->hasMany('App\Models\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cvpCodes()
    {
        return $this->hasMany('App\Models\CvpCode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function financialReportCodes()
    {
        return $this->hasMany('App\Models\FinancialReportCode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function legalAddresses()
    {
        return $this->hasMany('App\Models\LegalAddress', 'country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function legalForms()
    {
        return $this->hasMany('App\Models\LegalForm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licensedActivities()
    {
        return $this->hasMany('App\Models\LicensedActivity');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unlicensedActivities()
    {
        return $this->hasMany('App\Models\UnlicensedActivity');
    }
}
