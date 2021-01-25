<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * @var array
     */
    protected $fillable = ['country_code', 'country_name', 'capital', 'languages','code_phone','data_show', 'created_at', 'updated_at'];


    protected $casts =[
        'languages' => 'array'
    ];

    /**
     * @return HasMany
     */
    public function companies():HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * @return HasMany
     */
    public function cvpCodes(): HasMany
    {
        return $this->hasMany(CvpCode::class);
    }

    /**
     * @return HasMany
     */
    public function financialReportCodes(): HasMany
    {
        return $this->hasMany(FinancialReportCode::class);
    }

    /**
     * @return HasMany
     */
    public function legalAddresses(): HasMany
    {
        return $this->hasMany(LegalAddress::class, 'country');
    }

    /**
     * @return HasMany
     */
    public function legalForms(): HasMany
    {
        return $this->hasMany(LegalForm::class);
    }

    /**
     * @return HasMany
     */
    public function licensedActivities(): HasMany
    {
        return $this->hasMany(LicensedActivity::class);
    }

    /**
     * @return HasMany
     */
    public function unlicensedActivities(): HasMany
    {
        return $this->hasMany(UnlicensedActivity::class);
    }
}
