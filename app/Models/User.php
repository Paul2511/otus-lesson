<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const VIEW_ANY = 'viewAny';
    const VIEW = 'view';
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';
    const ADMIN = 'admin';
    const MANAGER = 'manager';
    const DEVELOPER = 'developer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'patronymic',
        'email',
        'password',
        'role',
        'skills'
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
    public function own_tasks(){
    	return $this->hasMany(Task::class);
    }
    public function tasks(){
    	return $this->belongsToMany(Task::class);
    }
    public function clients(){
    	return $this->hasMany(Client::class);
    }
    public function knowledges(){
    	return $this->hasMany(Knowledge::class);
    }
    public function comments(){
    	return $this->hasMany(Comment::class);
    }
}
