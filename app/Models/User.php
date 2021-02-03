<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

/**
 * Class User
 * @package App\Models
 */

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const LEVEL_USER = 10;
    const LEVEL_MODERATOR = 20;
    const LEVEL_ADMIN = 30;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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


    public function user_profile(){
        $this->hasOne(UserProfile::class);
    }

    public function isAdmin(){
        return $this->level === self::LEVEL_ADMIN;
    }

    public function isModerator(){
        return $this->level === self::LEVEL_MODERATOR;
    }

    public function isUser(){
        return $this->level === self::LEVEL_USER;
    }
    
    public function role(){
        return $this->hasOne(Role::class);
    }
}
