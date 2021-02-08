<?php

namespace App\Models;

use App\Events\Specialization\SpecializationDeleted;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\LocaleTranslator;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Watson\Rememberable\Rememberable;

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
    use HasFactory, LocaleTranslator, Rememberable, Searchable;

    public $timestamps = false;

    protected $rememberCachePrefix = 'specializations';

    protected $fillable = [
        'slug'
    ];

    protected $appends = [
        'title', 'canDelete'
    ];

    protected $dispatchesEvents = [
        'deleted'=>SpecializationDeleted::class
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

    public function toSearchableArray() : array
    {
        $result = [
            'id' => $this->id,
            'model_id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title
        ];

        $translates = $this->translates->toArray();
        if (isset($translates) && count($translates)) {
            foreach ($translates as $translate) {
                $result['locale_'.$translate['locale']] = $translate['value'];
            }
        }

        return $result;
    }

    /**
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function makeAllSearchableUsing($query)
    {
        return $query->with('translates');
    }
}
