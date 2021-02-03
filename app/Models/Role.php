<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    const STARUS_INACTIVE = 0;
    const STARUS_PANDING = 10;
    const STARUS_ACTIVE = 20;
    const STARUS_PAUSED = 30;
    const STARUS_DELETED = 40;
    
    protected $fillable = [
        'name',
        'status',
        'permissions'
    ];
    
    protected $casts = [
        'permissions' => 'array'
    ];
    
    
}
