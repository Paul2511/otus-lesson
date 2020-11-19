<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UseUuid;

/**
 * App\Models\User
 *
 * @property string $id
 * @property int $status
 * @property string $name
 * @property string $login
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $phone_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Room[] $rooms
 * @property-read int|null $rooms_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use HasFactory, Notifiable, UseUuid, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    const STATUS_INACTIVE = 10;
    const STATUS_MODERATION = 20;
    const STATUS_ACTIVE = 30;
    const STATUS_DELETED_BY_OWNER = 40;
    const STATUS_DELETED_BY_ADMIN = 50;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'login',
        'email',
        'phone',
        'status',
        'password',
        'email_verified_at',
        'phone_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Поля с приведением к нативным типам
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    /**
     * Список доступных статусов сущности
     *
     * @return array
     */
    public static function getStatuses() {
        return [
            self::STATUS_INACTIVE,
            self::STATUS_MODERATION,
            self::STATUS_ACTIVE,
            self::STATUS_DELETED_BY_OWNER,
            self::STATUS_DELETED_BY_ADMIN,
        ];
    }

    /**
     * Получить роли пользователя
     */
    public function roles()
    {
        return $this
            ->belongsToMany(Role::class);
    }

    /**
     * Получить настройки пользователя
     */
    public function settings()
    {
        return $this
            ->hasMany(SettingsUser::class);
    }

    /**
     * Получить чаты пользователя
     */
    public function rooms()
    {
        return $this
            ->belongsToMany(Room::class);
    }

    /**
     * Получить посты пользователя
     */
    public function posts()
    {
        return $this
            ->hasMany(Post::class);
    }
}
