<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use App\Casts\Phone;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role
 * @property int $status
 * @property string|null $phone
 * @property-read \App\Models\Team $currentTeam
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static Builder|User whereTwoFactorSecret($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @method static Builder|User          active()
 * @method static Builder|User          client()
 * @method static Builder|User          spec()
 * @property-read bool                  $isAdmin
 * @property-read bool                  $isClient
 * @property-read bool                  $phoneFormat
 *
 * @property-read Collection|Pet[]      $pets
 * @property-read Collection|UserDetail $detail
 * @property-read Collection|Lead[]     $leads
 * @property-read Collection|Lead[]     $managerLeads
 * @property-read Collection|Request[]  $requests
 * @property-read Collection|Request[]  $specRequests
 * @property-read Collection|Comment[]  $commentsByUser
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ROLE_CLIENT = 10;
    const ROLE_SPEC = 20;
    const ROLE_MANAGER = 30;
    const ROLE_ADMIN = 40;

    const STATUS_ACTIVE = 10;
    const STATUS_NOT_ACTIVE = 20;

    protected $fillable = [
        'email', 'password', 'role', 'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'created_at',
        'updated_at',
        'name'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i',
        'phone' => Phone::class
    ];


    protected $appends = [
        'phoneFormat'
    ];

    /**
     * Питомцы клиента
     */
    public function pets()
    {
        return $this->hasMany(Pet::class, 'client_id');
    }

    /**
     * Подробная информация о клиенте/специалисте
     */
    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    /**
     * Лиды от клиента/специалиста
     */
    public function leads()
    {
       return $this->hasMany(Lead::class);
    }

    /**
     * Лиды, назначенные менеджеру
     */
    public function managerLeads()
    {
        return $this->hasMany(Lead::class, 'manager_id');
    }

    /**
     * Заявки клиента
     */
    public function requests()
    {
        return $this->hasMany(Request::class, 'client_id');
    }

    /**
     * Заявки, назначенные на специалиста
     */
    public function specRequests()
    {
        return $this->hasMany(Request::class);
    }

    /**
     * Все комментарии пользователя
     */
    public function commentsByUser()
    {
        return $this->hasMany(Comment::class);
    }


    public function scopeActive(Builder $query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeClient(Builder $query)
    {
        return $query->where('role', self::ROLE_CLIENT);
    }


    public function scopeSpec(Builder $query)
    {
        return $query->where('role', self::ROLE_SPEC);
    }

    public function getIsAdminAttribute()
    {
        return $this->attributes['role'] === self::ROLE_ADMIN;
    }

    public function getIsClientAttribute()
    {
        return $this->attributes['role'] === self::ROLE_CLIENT;
    }

    public function getPhoneFormatAttribute()
    {
        return Phone::formatPhone($this->attributes['phone']);
    }

}
