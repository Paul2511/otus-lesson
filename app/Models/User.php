<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
class User extends Model
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
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'phone', 'sex', 'type', 'email_verified_at', 'last_login_at', 'status', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany('App\Models\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderNotes()
    {
        return $this->hasMany('App\Models\OrderNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planUsersOwner()
    {
        return $this->hasMany('App\Models\PlanUser', 'owner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planUsers()
    {
        return $this->hasMany('App\Models\Plan');
    }
}
