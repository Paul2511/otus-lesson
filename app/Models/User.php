<?php

namespace App\Models;

use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Casts\Phone;
use Illuminate\Database\Eloquent\Builder;
use Watson\Rememberable\Rememberable;
use App\Events\User\UserUpdated;
use App\Events\User\UserCreated;
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
 * @property string $locale
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
 * @method static Builder|User remember($seconds, $key=null)
 * @method static Builder|User flushCache($key)
 * @mixin \Eloquent
 *
 * @method static Builder|User          active()
 * @method static Builder|User          client()
 * @method static Builder|User          spec()
 * @property-read bool                  $isAdmin
 * @property-read bool                  $isManager
 * @property-read bool                  $phoneFormat
 *
 * @property-read Collection|Pet[]      $pets
 * @property-read Collection|UserDetail $userDetail
 * @property-read Collection|Lead[]     $leads
 * @property-read Collection|Lead[]     $managerLeads
 * @property-read Collection|Request[]  $requests
 * @property-read Collection|Request[]  $specRequests
 * @property-read Collection|Comment[]  $commentsByUser
 */
class User extends Authenticatable implements JWTSubject, HasLocalePreference
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Rememberable;

    const ROLE_CLIENT = 'client';
    const ROLE_SPEC = 'spec';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';

    const STATUS_ACTIVE = 10;
    const STATUS_NOT_ACTIVE = 20;

    const EMPTY_NAME = '-';

    public static $modelName = 'user';

    /** @var string */
    public $clientPassword;

    /**
     * @var bool
     */
    public $sendWelcomeEmail = false;

    protected $fillable = [
        'email', 'password', 'role', 'status', 'locale'
    ];

    public function preferredLocale()
    {
        return $this->locale;
    }

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'created_at',
        'updated_at',
        'name',
        'userDetail'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i',
        'phone' => Phone::class
    ];


    protected $appends = [
        'phoneFormat'
    ];

    protected $rememberCachePrefix = 'users';

    protected $dispatchesEvents = [
        'created'=>UserCreated::class,
        'updated'=>UserUpdated::class
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
    public function userDetail()
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

    public function getDetailAttribute()
    {
        return $this->userDetail()->first()->toArray();
    }

    public function getPhoneFormatAttribute()
    {
        return Phone::formatPhone($this->attributes['phone']);
    }

    public function getIsAdminAttribute()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function getIsManagerAttribute()
    {
        return $this->role === self::ROLE_MANAGER;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'role'=>$this->role
        ];
    }

    public function fill(array $attributes)
    {
        if (isset($attributes['sendWelcomeEmail'])) {
            $this->sendWelcomeEmail = $attributes['sendWelcomeEmail'];
            unset($attributes['sendWelcomeEmail']);
        }

        if (isset($attributes['clientPassword'])) {
            $this->clientPassword = $attributes['clientPassword'];
            unset($attributes['clientPassword']);
        }

        return parent::fill($attributes);
    }
}
