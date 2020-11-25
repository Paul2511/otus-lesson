<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Role
 *
 * @package App\Models
 * @property inn $id
 * @property string $name
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 */
class Role extends Model
{
    use HasFactory;

    const ROLE_USER = 0;
    const ROLE_MANAGER = 10;
    const ROLE_ADMIN = 20;

    public static $roles = [
        self::ROLE_USER => 'User',
        self::ROLE_MANAGER => 'Manager',
        self::ROLE_ADMIN => 'Admin',
    ];

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public static function roles()
    {
        return self::roles();
    }

    public static function getRoleAttribute()
    {
        return self::roles($roles[$value]);
    }

    public function users()
    {
        return $this->hasMany(User::class)
            ->using(RoleUser::class);
    }

    public function isAdmin()
    {
        return Auth::user()->role == self::ROLE_ADMIN;
    }

}
