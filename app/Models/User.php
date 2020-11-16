<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class User
 *
 * @package App\Models
 * @property int $inn
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $role_id
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereInn($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User whereMiddleName($value)
 * @method static Builder|User whereOtp($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User wherePosition($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRoleId($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $position
 * @property int $phone
 * @property string $email
 * @property string $password
 * @property int $otp
 * @property int $status
 */

class User extends Authenticatable
{
    use  HasFactory,Notifiable;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_PENDING = 20;
    const STATUS_DELETED = 30;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'middletName',
        'position',
        'phone',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'otp',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'email_verified_at',
    ];

    public function roles()
    {
        return $this->hasMany(Role::class)
            ->using(RoleUser::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class)
            ->using(CompanyUser::class);
    }

}
