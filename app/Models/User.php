<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 *
 * @property int $id
 * @property int $role
 * @property string $email
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $phone
 * @property Carbon $birthday
 * @property int $file_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_ANONYMOUS = 10;
    public const ROLE_GUEST = 20;
    public const ROLE_TRAINER = 30;
    public const ROLE_ADMIN = 40;

    public const ROLE_NAME_ANONYMOUS = 'ANONYMOUS';
    public const ROLE_NAME_GUEST = 'GUEST';
    public const ROLE_NAME_TRAINER = 'TRAINER';
    public const ROLE_NAME_ADMIN = 'ADMIN';

    /**
     * @var array
     */
    protected $fillable = [
        'role',
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'birthday',
        'file_id',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'remember_token',
        'email_verified_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'role' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string',
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'phone' => 'string',
        'birthday' => 'date',
        'file_id' => 'integer',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    /**
     * сущность чата сообщений "Обратная связь", привязывается к гостю
     * @return HasMany
     */
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class, 'user_id');
    }

    /**
     * сообщения "Обратная связь"
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    /**
     * комментарии
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * уведомления
     * @return BelongsToMany
     */
    public function notifications(): BelongsToMany
    {
        return $this->belongsToMany(Notification::class, 'notification_user');
    }

    /**
     * клубные карты
     * @return BelongsToMany
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_user');
    }

    /**
     * записи гостя
     * @return BelongsToMany
     */
    public function schedules(): BelongsToMany
    {
        return $this->belongsToMany(Schedule::class, 'schedule_user');
    }

    /**
     * записи трененра
     * @return HasMany
     */
    public function trainerSchedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'user_id');
    }

    /**
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_NAME_ANONYMOUS => self::ROLE_ANONYMOUS,
            self::ROLE_NAME_GUEST => self::ROLE_GUEST,
            self::ROLE_NAME_TRAINER => self::ROLE_TRAINER,
            self::ROLE_NAME_ADMIN => self::ROLE_ADMIN,
        ];
    }
}
