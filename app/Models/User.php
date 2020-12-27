<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $sex
 * @property int $type
 * @property string $email_verified_at
 * @property string $last_login_at
 * @property int $status
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Company[] $companies
 * @property News[] $news
 * @property OrderNote[] $orderNotes
 * @property Order[] $orders
 * @property PlanUser[] $planUsers
 * @property PlanUser[] $planUsersOwner
 */
class User extends Authenticate
{
    use HasFactory;

    /**
     * Types of users
     */
    public const TYPE_ADMIN = 10;
    public const TYPE_MANAGER = 20;
    public const TYPE_USER = 50;

    /**
     * Status of users
     */
    public const STATUS_DELETED = 1;
    public const STATUS_LOCKED = 5;
    public const STATUS_INACTIVE = 9;
    public const STATUS_ACTIVE = 10;

    /**
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'phone', 'sex', 'type', 'email_verified_at', 'last_login_at', 'status', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return BelongsToMany
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    /**
     * @return HasMany
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }

    /**
     * @return HasMany
     */
    public function orderNotes(): HasMany
    {
        return $this->hasMany(OrderNote::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany
     */
    public function planUsersOwner(): HasMany
    {
        return $this->hasMany(PlanUser::class, 'owner_id');
    }

    /**
     * @return HasMany
     */
    public function planUsers(): HasMany
    {
        return $this->hasMany(Plan::class);
    }

    /**
     * @return bool
     */
    final public function isAdmin():bool {
        return $this->type === self::TYPE_ADMIN;
    }

    /**
     * @return bool
     */
    final public function isUser():bool {
        return $this->type === self::TYPE_USER;
    }

    /**
     * @return bool
     */
    final public function isManager():bool {
        return $this->type === self::TYPE_MANAGER;
    }
}
