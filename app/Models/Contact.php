<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $company_id
 * @property integer $contact_type_id
 * @property string $value
 * @property string $comment
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property ContactType $contactType
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['company_id', 'contact_type_id', 'value', 'comment', 'status', 'created_at', 'updated_at'];

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
    public function contactType():BelongsTo
    {
        return $this->belongsTo(ContactType::class);
    }
}
