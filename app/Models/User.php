<?php

namespace App\Models;

use App\Models\Casts\PhoneCast;
use App\Models\Casts\User\AvatarCast;
use App\Models\Casts\User\NameCast;
use App\Models\Traits\HasComments;
use App\Models\Traits\UserTimezoneTrait;
use App\Services\Files\DTO\ImageData;
use App\States\User\Role\AdminUserRole;
use App\States\User\Role\ClientUserRole;
use App\States\User\Role\ManagerUserRole;
use App\States\User\Role\SpecialistUserRole;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;
use Support\Person\PersonName\PersonNameData;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Watson\Rememberable\Rememberable;
use App\Events\User\UserUpdated;
use App\Events\User\UserCreated;
use Spatie\ModelStates\HasStates;
use App\States\User\Status\UserStatus;
use App\States\User\Role\UserRole;
/**
 * App\Models\User
 *
 * @property int $id
 * @property PersonNameData $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property UserRole $role
 * @property UserStatus $status
 * @property string|null $phone
 * @property string $locale
 * @property ImageData|null $avatar
 * @property string $timezone
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User remember($seconds, $key=null)
 * @method static Builder|User flushCache($key)
 * @mixin \Eloquent
 *
 * @property-read bool                  $isAdmin
 * @property-read bool                  $isManager
 * @property-read bool                  $isClient
 * @property-read bool                  $isSpecialist
 * @property-read bool                  $canManage
 *
 * @property-read Collection|Comment[]  $commentsByUser
 * @property-read Collection|Comment[] $comments
 * @property-read Collection|Client     $client
 * @property-read Collection|Specialist $specialist
 * @property-read Collection|Lead[]     $leads
 * @property-read Collection|Lead[]     $managerLeads
 */
class User extends Authenticatable implements JWTSubject, HasLocalePreference
{
    use HasApiTokens, HasFactory, Notifiable, Rememberable, Rememberable, HasStates, Searchable, HasComments, UserTimezoneTrait;

    public string $clientPassword;

    //Спецефические данные формы для регистрации пользователя с ролью
    public array $clientData = [];
    public array $specialistData = [];
    public array $managerData = [];
    public array $adminData = [];

    /**
     * @var bool
     */
    public $sendWelcomeEmail = false;

    protected $fillable = [
        'email', 'password', 'phone', 'status', 'locale', 'role', 'name', 'avatar', 'status'
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
        'updated_at',
        'status',
        'role'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime:d.m.Y H:i',
        'created_at' => 'datetime:d.m.Y H:i',
        'name' => NameCast::class,
        'phone' => PhoneCast::class,
        'avatar'=>AvatarCast::class,
        'status'=>UserStatus::class,
        'role'=>UserRole::class
    ];

    protected $appends = [
        'currentStatus', 'currentRole', 'specialist', 'formatCreatedAt'
    ];

    protected $rememberCachePrefix = 'users';

    protected $dispatchesEvents = [
        'created'=>UserCreated::class,
        'updated'=>UserUpdated::class
    ];

    public function toSearchableArray() : array
    {
        $result = [
            'id' => $this->id,
            'name' => $this->name->fullName,
            'email' => $this->email
        ];

        return $result;
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function specialist()
    {
        return $this->hasOne(Specialist::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function managerLeads()
    {
        return $this->hasMany(Lead::class, 'manager_id');
    }

    public function commentsByUser()
    {
        return $this->hasMany(Comment::class);
    }

    public function getCurrentStatusAttribute()
    {
        return $this->status ? [
            'status'=>$this->status->getValue(),
            'label'=>$this->status->label(),
            'color'=>$this->status->color()
        ] : null;
    }

    public function getCurrentRoleAttribute()
    {
        return [
            'role'=>$this->role->getValue(),
            'label'=>$this->role->label()
        ];
    }

    public function getIsAdminAttribute()
    {
        return $this->role->equals(AdminUserRole::$name);
    }

    public function getIsManagerAttribute()
    {
        return $this->role->equals(ManagerUserRole::$name);
    }

    public function getIsClientAttribute()
    {
        return $this->role->equals(ClientUserRole::$name);
    }

    public function getIsSpecialistAttribute()
    {
        return $this->role->equals(SpecialistUserRole::$name);
    }

    public function getSpecialistAttribute()
    {
        return $this->role->equals(SpecialistUserRole::$name) ? $this->specialist()->first()->toArray():null;
    }

    public function getCanManageAttribute()
    {
        return $this->role->canManage();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'role'=>$this->role->getValue()
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

        if (isset($attributes['clientData'])) {
            $this->clientData = $attributes['clientData'];
            unset($attributes['clientData']);
        }

        if (isset($attributes['specialistData'])) {
            $this->specialistData = $attributes['specialistData'];
            unset($attributes['specialistData']);
        }

        return parent::fill($attributes);
    }
}
