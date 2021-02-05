<?php

namespace App\Models;

use App\Events\PetType\PetTypeDeleted;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\LocaleTranslator;
use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;
use Laravel\Scout\Searchable;
/**
 * App\Models\PetType
 *
 * @property int $id
 * @property string $slug
 * @method static Builder|PetType newModelQuery()
 * @method static Builder|PetType newQuery()
 * @method static Builder|PetType query()
 * @method static Builder|PetType whereId($value)
 * @method static Builder|PetType whereSlug($value)
 * @method static Builder|PetType whereTitle($value)
 * @property Collection|Translate[] $translates
 * @property string $title
 * @mixin \Eloquent
 *
 * @property-read Collection|Pet[] $pets
 */
class PetType extends Model
{
    use HasFactory, LocaleTranslator, Rememberable, Searchable;

    protected $rememberCachePrefix = 'petTypes';

    public $timestamps = false;

    protected $fillable = [
        'slug'
    ];

    protected $appends = [
        'title', 'canDelete'
    ];

    protected $dispatchesEvents = [
        'deleted'=>PetTypeDeleted::class
    ];

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

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function getTitleAttribute()
    {
        return $this->translateAttribute($this->slug);
    }

    public function getCanDeleteAttribute()
    {
        return !$this->pets()->exists();
    }
}
