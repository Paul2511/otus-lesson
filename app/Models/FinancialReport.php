<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property integer $company_id
 * @property integer $financial_report_code_id
 * @property string $year
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property FinancialReportCode $financialReportCode
 */
class FinancialReport extends Model
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
    protected $fillable = ['company_id', 'financial_report_code_id', 'year', 'value', 'created_at', 'updated_at'];

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
    public function financialReportCode()
    {
        return $this->belongsTo('App\Models\FinancialReportCode');
    }
}
