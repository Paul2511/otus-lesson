<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 */
class Leader extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['company_id', 'title', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
