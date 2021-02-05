<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\LocaleTranslator;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Specialization
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @method static Builder|Specialization newModelQuery()
 * @method static Builder|Specialization newQuery()
 * @method static Builder|Specialization query()
 * @method static Builder|Specialization whereId($value)
 * @method static Builder|Specialization whereSlug($value)
 *
 * @property-read Collection|Specialist[]   $specialists
 * @property Collection|Translate[] $translates
 * @mixin \Eloquent
 *
 */
class Specialization extends Model
{
    use HasFactory, LocaleTranslator;

    public $timestamps = false;

    protected $rememberCachePrefix = 'specializations';

    protected $fillable = [
        'slug'
    ];

    protected $appends = [
        'title', 'canDelete'
    ];

    public function specialists()
    {
        return $this->hasMany(Specialist::class);
    }

    public function getTitleAttribute()
    {
        return $this->translateAttribute($this->slug);
    }

    public function getCanDeleteAttribute()
    {
        return !$this->specialists()->exists();
    }
}
