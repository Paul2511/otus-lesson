<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['cvp_code_id', 'company_id', 'ocid', 'title', 'text', 'value', 'currency', 'method', 'method_detail', 'published_date', 'published_name', 'start_date', 'end_date', 'cvp_description', 'url', 'year', 'status', 'status_details', 'created_at', 'updated_at'];

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
    public function cvpCode()
    {
        return $this->belongsTo('App\Models\CvpCode');
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
    public function tenderAwards()
    {
        return $this->hasMany('App\Models\TenderAward');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenderDocuments()
    {
        return $this->hasMany('App\Models\TenderDocument');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenderItems()
    {
        return $this->hasMany('App\Models\TenderItem');
    }
}
