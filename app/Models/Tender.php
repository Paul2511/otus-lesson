<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @property integer $id
 * @property integer $cvp_code_id
 * @property integer $company_id
 * @property string $ocid
 * @property string $title
 * @property string $text
 * @property int $value
 * @property string $currency
 * @property string $method
 * @property string $method_detail
 * @property string $published_date
 * @property string $published_name
 * @property string $start_date
 * @property string $end_date
 * @property string $cvp_description
 * @property string $url
 * @property string $year
 * @property string $status
 * @property string $status_details
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property CvpCode $cvpCode
 * @property ContactTender[] $contactTenders
 * @property TenderAward[] $tenderAwards
 * @property TenderDocument[] $tenderDocuments
 * @property TenderItem[] $tenderItems
 */
class Tender extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['cvp_code_id', 'company_id', 'ocid', 'title', 'text', 'value', 'currency', 'method', 'method_detail', 'published_date', 'published_name', 'start_date', 'end_date', 'cvp_description', 'url', 'year', 'status', 'status_details', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return BelongsTo
     */
    public function cvpCode(): BelongsTo
    {
        return $this->belongsTo(CvpCode::class);
    }

    /**
     * @return HasMany
     */
    public function contactTenders(): HasMany
    {
        return $this->hasMany(ContactTender::class);
    }

    /**
     * @return HasMany
     */
    public function tenderAwards(): HasMany
    {
        return $this->hasMany(TenderAward::class);
    }

    /**
     * @return HasMany
     */
    public function tenderDocuments(): HasMany
    {
        return $this->hasMany(TenderDocument::class);
    }

    /**
     * @return HasMany
     */
    public function tenderItems(): HasMany
    {
        return $this->hasMany(TenderItem::class);
    }
}
