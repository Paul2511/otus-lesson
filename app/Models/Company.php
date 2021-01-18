<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Watson\Rememberable\Rememberable;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $company_uuid
 * @property string $name
 * @property string $full_name
 * @property int $inn
 * @property int $kpp
 * @property int $ogrn
 * @property Carbon $ogrn_date
 * @property int $phone
 * @property string|null $address_legal
 * @property string|null $address_actual
 * @property string $card_num
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Specialist[] $specialists
 * @property-read int|null $specialists_count
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 * @method static Builder|Company where1cCompanyUuid($value)
 * @method static Builder|Company whereAddressActual($value)
 * @method static Builder|Company whereAddressLegal($value)
 * @method static Builder|Company whereCardNum($value)
 * @method static Builder|Company whereCreatedAt($value)
 * @method static Builder|Company whereFullName($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereInn($value)
 * @method static Builder|Company whereKpp($value)
 * @method static Builder|Company whereName($value)
 * @method static Builder|Company whereOgrn($value)
 * @method static Builder|Company whereOgrnDate($value)
 * @method static Builder|Company wherePhone($value)
 * @method static Builder|Company whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    use HasFactory, Rememberable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_uuid',
        'name',
        'fullName',
        'inn',
        'kpp',
        'ogrn',
        'ogrn_date',
        'phone',
        'address_legal',
        'address_actual',
        'card_num',
    ];

    protected $dates = [
        'ogrn_date',
    ];

    public function users()
    {
        return $this->hasMany(User::class)
            ->using(CompanyUser::class);
    }

    public function specialists()
    {
        return $this->hasMany(Specialist::class, 'company_uuid');
    }


}
