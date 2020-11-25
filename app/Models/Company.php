<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * @var array
     */
    protected $fillable = ['legal_form_id', 'country_id', 'identification_code', 'title', 'clear_title', 'raw_title', 'slug', 'description', 'registration_date', 'status', 'vat', 'vat_register_date', 'vat_cancel_date', 'excise', 'excise_register_date', 'excise_cancel_date', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return BelongsTo
     */
    public function legalForm():BelongsTo
    {
        return $this->belongsTo(LegalForm::class);
    }

    /**
     * @return BelongsToMany
     */
    public function cvpCodes():BelongsToMany
    {
        return $this->belongsToMany(CvpCode::class, null, null, 'cvp_code');
    }

    /**
     * @return BelongsToMany
     */
    public function licensedActivities():BelongsToMany
    {
        return $this->belongsToMany(LicensedActivity::class);
    }

    /**
     * @return BelongsToMany
     */
    public function unlicensedActivities():BelongsToMany
    {
        return $this->belongsToMany(UnlicensedActivity::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return HasMany
     */
    public function contactTenders():HasMany
    {
        return $this->hasMany(ContactTender::class);
    }

    /**
     * @return HasMany
     */
    public function contacts():HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * @return HasMany
     */
    public function financialReports():HasMany
    {
        return $this->hasMany(FinancialReport::class);
    }

    /**
     * @return HasMany
     */
    public function founders():HasMany
    {
        return $this->hasMany(Founder::class);
    }

    /**
     * @return HasMany
     */
    public function historyCompanies():HasMany
    {
        return $this->hasMany(HistoryCompany::class);
    }

    /**
     * @return HasMany
     */
    public function leaders():HasMany
    {
        return $this->hasMany(Leader::class);
    }

    /**
     * @return HasMany
     */
    public function legalAddresses():HasMany
    {
        return $this->hasMany(LegalAddress::class);
    }

    /**
     * @return HasMany
     */
    public function tenderAwards():HasMany
    {
        return $this->hasMany(TenderAward::class);
    }

    /**
     * @return HasMany
     */
    public function tenders() :HasMany
    {
        return $this->hasMany(Tender::class);
    }
}
