<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $country_id
 * @property string $type
 * @property string $code
 * @property string $title
 * @property mixed $aliases
 * @property string $created_at
 * @property string $updated_at
 * @property Country $country
 * @property FinancialReport[] $financialReports
 */
class FinancialReportCode extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['country_id', 'type', 'code', 'title', 'aliases', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return HasMany
     */
    public function financialReports(): HasMany
    {
        return $this->hasMany(FinancialReport::class);
    }
}
