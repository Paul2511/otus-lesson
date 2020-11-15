<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * App\Models\Specialist
 *
 * @property int $id
 * @property string $company_uuid
 * @property string $specialist_uuid
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string $dob
 * @property string|null $position
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Company[] $company
 * @property-read int|null $company_count
 * @property-read Collection|Service[] $services
 * @property-read int|null $services_count
 * @method static Builder|Specialist newModelQuery()
 * @method static Builder|Specialist newQuery()
 * @method static Builder|Specialist query()
 * @method static Builder|Specialist where1cCompanyUuid($value)
 * @method static Builder|Specialist where1cSpecialistUuid($value)
 * @method static Builder|Specialist whereCreatedAt($value)
 * @method static Builder|Specialist whereDob($value)
 * @method static Builder|Specialist whereFirstName($value)
 * @method static Builder|Specialist whereId($value)
 * @method static Builder|Specialist whereLastName($value)
 * @method static Builder|Specialist whereMiddleName($value)
 * @method static Builder|Specialist wherePosition($value)
 * @method static Builder|Specialist whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Specialist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_uuid',
        'specialist_uuid',
        'firstName',
        'lastName',
        'middleName',
        'dob',
        'position',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_uuid');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'specialist_uuid');
    }
}
