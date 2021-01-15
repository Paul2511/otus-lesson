<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(int[] $array)
 */
class UserRole extends Model
{
    protected $fillable = [
        'user_id', 'role_id'
    ];

    public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }
}
