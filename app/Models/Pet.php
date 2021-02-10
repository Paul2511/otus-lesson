<?php

namespace App\Models;

use App\Events\Pet\PetCreated;
use App\Events\Pet\PetDeleted;
use App\Events\Pet\PetUpdated;
use App\Services\Files\DTO\ImageData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Casts\Pet\PhotoCast;
use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasComments;
use Spatie\ModelStates\HasStates;
use App\States\Pet\Sex\PetSex;
use Laravel\Scout\Searchable;
/**
 * App\Models\Pet
 *
 * @property int $id
 * @property int $pet_type_id
 * @property int $client_id
 * @property string $name
 * @property int|null $age в месяцах
 * @property string|null $bread
 * @property PetSex|null $sex
 * @property ImageData|null $photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Pet newModelQuery()
 * @method static Builder|Pet newQuery()
 * @method static Builder|Pet query()
 * @method static Builder|Pet whereAge($value)
 * @method static Builder|Pet whereBread($value)
 * @method static Builder|Pet whereClientId($value)
 * @method static Builder|Pet whereCreatedAt($value)
 * @method static Builder|Pet whereId($value)
 * @method static Builder|Pet whereName($value)
 * @method static Builder|Pet wherePetTypeId($value)
 * @method static Builder|Pet wherePhoto($value)
 * @method static Builder|Pet whereSex($value)
 * @method static Builder|Pet whereUpdatedAt($value)
 * @method static Builder|Pet remember($seconds, $key=null)
 * @method static Builder|Pet flushCache($key)
 * @mixin \Eloquent
 *
 * @property-read Collection|Client $client
 * @property-read Collection|PetType $petType
 */
class Pet extends Model
{
    use HasFactory, Rememberable, HasComments, HasStates, Searchable;

    protected $rememberCachePrefix = 'pets';

    protected $fillable = [
        'pet_type_id', 'name', 'age', 'bread', 'sex', 'photo', 'client_id'
    ];

    protected $hidden = [
        'updated_at'
    ];

    protected $casts = [
        'photo' => PhotoCast::class,
        'sex' => PetSex::class,
        'created_at' => 'datetime:d.m.Y H:i'
    ];

    protected $appends = [
        'petTypeTitle', 'currentSex', 'canDelete'
    ];

    protected $dispatchesEvents = [
        'updated'=>PetUpdated::class,
        'deleted'=>PetDeleted::class,
        'created'=>PetCreated::class
    ];

    public function toSearchableArray() : array
    {
        $result = [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'name' => $this->name,
            'sex' => $this->sex
        ];

        if ($this->petType && $this->petType->title) {
            $result['petType'] = $this->petType->title;
        }

        if ($this->bread) {
            $result['bread'] = $this->bread;
        }

        return $result;
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }


    public function petType()
    {
        return $this->belongsTo(PetType::class);
    }


    public function getPetTypeTitleAttribute()
    {
        $petType = $this->petType;
        return $petType->title ?? '';
    }

    public function getCurrentSexAttribute()
    {
        return [
            'sex'=>$this->sex->getValue(),
            'label'=>$this->sex->label()
        ];
    }

    public function getCanDeleteAttribute()
    {
        return true;
    }
}
