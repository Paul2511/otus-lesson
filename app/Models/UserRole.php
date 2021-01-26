<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @method static create(int[] $array)
 */
class UserRole extends Pivot
{
    protected $fillable = [
        'user_id', 'role_id'
    ];

    public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }
}
