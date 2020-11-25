<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $title
 * @property string $icon
 * @property string $created_at
 * @property string $updated_at
 * @property Contact[] $contacts
 */
class ContactType extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['title', 'icon', 'created_at', 'updated_at'];

    /**
     * @return HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
