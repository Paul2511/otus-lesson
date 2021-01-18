<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Watson\Rememberable\Rememberable;

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
    use HasFactory, Rememberable;

    const ROLE_USER = 0;
    const ROLE_MANAGER = 10;
    const ROLE_ADMIN = 20;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function abilities()
    {
        return $this->belongsTo(
            Ability::class,
            'id',
            'id',
            'ability_role')
            ->first()
            ->ability;
    }

    public function users()
    {
        return $this->hasMany(User::class,'role_id','id');
    }

    public function isAdmin(): bool
    {
        return $this->name === Role::ROLE_ADMIN;
    }

    public function isManager(): bool
    {
        return $this->name === Role::ROLE_MANAGER;
    }

    public function isUser(): bool
    {
        return $this->name === Role::ROLE_USER;
    }

}
