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

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class)
            ->using(RoleUser::class);
    }

}
