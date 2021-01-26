<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Watson\Rememberable\Rememberable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $full_name
 * @property int $is_admin
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $last_visit
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Setting[] $settings
 * @property-read int|null $settings_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastVisit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectUser[] $project_user
 * @property-read int|null $project_user_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ResourceUser[] $resource_user
 * @property-read int|null $resource_user_count
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, Rememberable;

    protected $fillable = [
        'email',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'full_name',
        'is_admin',
        'is_active',
        'last_visit',
        'remember_token',
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'last_visit' => 'datetime',
    ];

    public function settings(){
        return $this->hasMany(Setting::class);
    }

    public function resource_user(){
        return $this->hasMany(ResourceUser::class);
    }

    public function project_user(){
        return $this->hasMany(ProjectUser::class);
    }

    public function resources(){
        return $this->belongsToMany(Resource::class);
    }

    public function isAdmin(){
        return $this->is_admin;
    }

    public function hasPermission(int $resource_id):bool {
        return $this->resources()->where('resources.id',$resource_id)->count() > 0;
    }
}
