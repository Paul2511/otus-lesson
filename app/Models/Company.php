<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property integer $legal_form_id
 * @property integer $country_id
 * @property string $identification_code
 * @property string $title
 * @property string $clear_title
 * @property string $raw_title
 * @property string $slug
 * @property string $description
 * @property string $registration_date
 * @property int $status
 * @property string $vat
 * @property string $vat_register_date
 * @property string $vat_cancel_date
 * @property string $excise
 * @property string $excise_register_date
 * @property string $excise_cancel_date
 * @property string $created_at
 * @property string $updated_at
 * @property Country $country
 * @property LegalForm $legalForm
 * @property CvpCode[] $cvpCodes
 * @property LicensedActivity[] $licensedActivities
 * @property UnlicensedActivity[] $unlicensedActivities
 * @property User[] $users
 * @property ContactTender[] $contactTenders
 * @property Contact[] $contacts
 * @property FinancialReport[] $financialReports
 * @property Founder[] $founders
 * @property HistoryCompany[] $historyCompanies
 * @property Leader[] $leaders
 * @property LegalAddress[] $legalAddresses
 * @property TenderAward[] $tenderAwards
 * @property Tender[] $tenders
 */
class Company extends Model
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
    protected $fillable = ['legal_form_id', 'country_id', 'identification_code', 'title', 'clear_title', 'raw_title', 'slug', 'description', 'registration_date', 'status', 'vat', 'vat_register_date', 'vat_cancel_date', 'excise', 'excise_register_date', 'excise_cancel_date', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function legalForm()
    {
        return $this->belongsTo('App\Models\LegalForm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cvpCodes()
    {
        return $this->belongsToMany('App\Models\CvpCode', null, null, 'cvp_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function licensedActivities()
    {
        return $this->belongsToMany('App\Models\LicensedActivity');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function unlicensedActivities()
    {
        return $this->belongsToMany('App\Models\UnlicensedActivity');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactTenders()
    {
        return $this->hasMany('App\Models\ContactTender');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function financialReports()
    {
        return $this->hasMany('App\Models\FinancialReport');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function founders()
    {
        return $this->hasMany('App\Models\Founder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historyCompanies()
    {
        return $this->hasMany('App\Models\HistoryCompany');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaders()
    {
        return $this->hasMany('App\Models\Leader');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function legalAddresses()
    {
        return $this->hasMany('App\Models\LegalAddress');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenderAwards()
    {
        return $this->hasMany('App\Models\TenderAward');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenders()
    {
        return $this->hasMany('App\Models\Tender');
    }
}
