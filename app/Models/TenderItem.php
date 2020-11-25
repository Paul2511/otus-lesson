<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $tender_id
 * @property integer $cvp_code_id
 * @property string $description
 * @property float $quantity
 * @property string $unit
 * @property string $cvp_description
 * @property string $related_lot
 * @property string $created_at
 * @property string $updated_at
 * @property CvpCode $cvpCode
 * @property Tender $tender
 */
class TenderItem extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['tender_id', 'cvp_code_id', 'description', 'quantity', 'unit', 'cvp_description', 'related_lot', 'created_at', 'updated_at'];

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
    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }
}
