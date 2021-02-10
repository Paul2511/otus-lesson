<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed level
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const LEVEL_USER = 20;
    const LEVEL_MODERATOR = 40;
    const LEVEL_ADMIN = 60;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'level',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->level === self::LEVEL_ADMIN;
    }

    public function isModerator(): bool
    {
        return $this->level === self::LEVEL_MODERATOR;
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }
}
