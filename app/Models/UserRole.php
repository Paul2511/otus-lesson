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
}
