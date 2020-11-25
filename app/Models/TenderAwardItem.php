<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property integer $id
 * @property integer $tender_award_id
 * @property integer $cvp_code_id
 * @property string $cvp_description
 * @property string $description
 * @property float $quantity
 * @property string $unit
 * @property float $value
 * @property string $created_at
 * @property string $updated_at
 * @property CvpCode $cvpCode
 * @property TenderAward $tenderAward
 */
class TenderAwardItem extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['tender_award_id', 'cvp_code_id', 'cvp_description', 'description', 'quantity', 'unit', 'value', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function cvpCode(): BelongsTo
    {
        return $this->belongsTo(CvpCode::class);
    }

    /**
     * @return BelongsTo
     */
    public function tenderAward(): BelongsTo
    {
        return $this->belongsTo(TenderAward::class);
    }
}
