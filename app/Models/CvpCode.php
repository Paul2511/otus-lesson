<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['parent_id', 'country_id', 'code', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cvpCode()
    {
        return $this->belongsTo('App\Models\CvpCode', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany('App\Models\Company', null, 'cvp_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenderAwardItems()
    {
        return $this->hasMany('App\Models\TenderAwardItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenderItems()
    {
        return $this->hasMany('App\Models\TenderItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenders()
    {
        return $this->hasMany('App\Models\Tender');
    }
}
