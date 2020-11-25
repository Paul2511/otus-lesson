<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
     * @var array
     */
    protected $fillable = ['company_id', 'tender_id', 'title', 'amount', 'currency', 'year', 'external_id', 'status', 'status_details', 'created_at', 'updated_at'];

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
    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }

    /**
     * @return HasMany
     */
    public function tenderAwardItems(): HasMany
    {
        return $this->hasMany(TenderAwardItem::class);
    }
}
