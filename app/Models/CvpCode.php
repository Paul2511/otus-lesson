<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property integer $country_id
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 * @property Country $country
 * @property CvpCode $cvpCode
 * @property Company[] $companies
 * @property TenderAwardItem[] $tenderAwardItems
 * @property TenderItem[] $tenderItems
 * @property Tender[] $tenders
 */
class CvpCode extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['parent_id', 'country_id', 'code', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return BelongsTo
     */
    public function cvpCode(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    /**
     * @return BelongsToMany
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, null, 'cvp_code');
    }

    /**
     * @return HasMany
     */
    public function tenderAwardItems(): HasMany
    {
        return $this->hasMany(TenderAwardItem::class);
    }

    /**
     * @return HasMany
     */
    public function tenderItems(): HasMany
    {
        return $this->hasMany(TenderItem::class);
    }

    /**
     * @return HasMany
     */
    public function tenders(): HasMany
    {
        return $this->hasMany(Tender::class);
    }
}
