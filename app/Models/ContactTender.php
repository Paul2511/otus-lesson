<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['tender_id', 'company_id', 'name', 'phone', 'email', 'fax', 'site', 'type', 'created_at', 'updated_at'];

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
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender');
    }
}
