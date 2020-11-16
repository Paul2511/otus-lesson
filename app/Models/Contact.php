<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['company_id', 'contact_type_id', 'value', 'comment', 'status', 'created_at', 'updated_at'];

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
    public function contactType()
    {
        return $this->belongsTo('App\Models\ContactType');
    }
}
