<?php

namespace App\Models;

use App\Events\Pet\PetDeleted;
use App\Events\Pet\PetUpdated;
use App\Services\Files\DTO\ImageData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Casts\PetPhotoCast;
use Watson\Rememberable\Rememberable;

/**
 * App\Models\Pet
 *
 * @property int $id
 * @property int $pet_type_id
 * @property int $client_id
 * @property string $name
 * @property int|null $age в месяцах
 * @property string|null $bread
 * @property int|null $sex
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
 * @property-read Collection|User $client
 * @property-read Collection|PetType $petType
 */
class Pet extends BaseModel
{
    use HasFactory;
    use Rememberable;

    const SEX_MALE = 'male';
    const SEX_FEMALE = 'female';

    protected $rememberCachePrefix = 'pets';
    public $commentType = 'pet';

    protected $fillable = [
        'pet_type_id', 'name', 'age', 'bread', 'sex', 'photo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'photo' => PetPhotoCast::class
    ];

    protected $appends = [
        'petTypeTitle', 'petTypes'
    ];

    public static $modelName = 'pet';

    protected $dispatchesEvents = [
        'updated'=>PetUpdated::class,
        'deleted'=>PetDeleted::class
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
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

    public function getPetTypesAttribute()
    {
        return PetType::all();
    }

}
