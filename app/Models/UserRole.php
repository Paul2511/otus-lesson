<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @method static create(int[] $array)
 */
class UserRole extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'role_id'
    ];

    protected $table = 'user_roles';

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
