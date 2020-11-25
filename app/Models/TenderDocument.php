<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $tender_id
 * @property string $title
 * @property string $usl
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Tender $tender
 */
class TenderDocument extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['tender_id', 'title', 'usl', 'description', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }
}
