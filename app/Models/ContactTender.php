<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $tender_id
 * @property integer $company_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $fax
 * @property string $site
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property Tender $tender
 */
class ContactTender extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['tender_id', 'company_id', 'name', 'phone', 'email', 'fax', 'site', 'type', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function company():BelongsTo
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
}
