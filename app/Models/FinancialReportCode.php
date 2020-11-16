<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['country_id', 'type', 'code', 'title', 'aliases', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function financialReports()
    {
        return $this->hasMany('App\Models\FinancialReport');
    }
}
