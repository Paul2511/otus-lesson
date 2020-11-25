<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @var array
     */
    protected $fillable = ['company_id', 'financial_report_code_id', 'year', 'value', 'created_at', 'updated_at'];

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
    public function financialReportCode(): BelongsTo
    {
        return $this->belongsTo(FinancialReportCode::class);
    }
}
