<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property integer $company_id
 * @property integer $tender_id
 * @property string $title
 * @property float $amount
 * @property string $currency
 * @property string $year
 * @property string $external_id
 * @property string $status
 * @property string $status_details
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property Tender $tender
 * @property TenderAwardItem[] $tenderAwardItems
 */
class TenderAward extends Model
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
    protected $fillable = ['company_id', 'tender_id', 'title', 'amount', 'currency', 'year', 'external_id', 'status', 'status_details', 'created_at', 'updated_at'];

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
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenderAwardItems()
    {
        return $this->hasMany('App\Models\TenderAwardItem');
    }
}
