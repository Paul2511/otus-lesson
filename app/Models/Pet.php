<?php

namespace App\Models;

use App\Helpers\UtilsHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

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
 * @property mixed|null $photo
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
 * @mixin \Eloquent
 *
 * @property-read Collection|User $client
 * @property-read Collection|PetType $petType
 */
class Pet extends BaseModel
{
    use HasFactory;

    const SEX_MALE = 'male';
    const SEX_FEMALE = 'female';

    /**
     * @var array
     */
    private static $sexLabels;

    public $commentType = 'pet';

    protected $fillable = [
        'pet_type_id', 'name', 'age', 'bread', 'sex', 'photo'
    ];


    protected $casts = [
        'photo' => 'array'
    ];


    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }


    public function petType()
    {
        return $this->belongsTo(PetType::class);
    }

    /**
     * @return array
     */
    public static function sexLabels()
    {
        if (isset(self::$sexLabels)) return self::$sexLabels;
        return self::$sexLabels = UtilsHelper::getLangLabels(static::class, 'sex', 'main');
    }
}
