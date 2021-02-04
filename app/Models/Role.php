<?php

namespace App\Models;

/**
 * Class Role
 * @package App\Models
 * @property int id
 * @property string name
 * @property int status
 * @property array permissions
 */
class Role extends Model
{

    const STATUS_INACTIVE = 0;
    const STATUS_PENDING = 10;
    const STATUS_ACTIVE = 20;
    const STATUS_PAUSE = 30;
    const STATUS_DELETED = 30;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'status',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];
}
