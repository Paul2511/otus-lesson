<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['tender_id', 'cvp_code_id', 'description', 'quantity', 'unit', 'cvp_description', 'related_lot', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cvpCode()
    {
        return $this->belongsTo('App\Models\CvpCode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender');
    }
}
