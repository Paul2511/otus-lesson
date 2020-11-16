<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property integer $tender_award_id
 * @property integer $cvp_code_id
 * @property string $cvp_description
 * @property string $description
 * @property float $quantitty
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
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['tender_award_id', 'cvp_code_id', 'cvp_description', 'description', 'quantitty', 'unit', 'value', 'created_at', 'updated_at'];

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
    public function tenderAward()
    {
        return $this->belongsTo('App\Models\TenderAward');
    }
}
