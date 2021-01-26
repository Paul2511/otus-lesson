<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, Factories\HasFactory, Relations\Pivot};
use Carbon\Carbon;

/**
 * App\Models\RoleHasPermission
 *
 * @property int $id
 * @property int $role_id
 * @property int $permission_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PermissionRole newModelQuery()
 * @method static Builder|PermissionRole newQuery()
 * @method static Builder|PermissionRole query()
 * @method static Builder|PermissionRole whereCreatedAt($value)
 * @method static Builder|PermissionRole whereId($value)
 * @method static Builder|PermissionRole wherePermissionsId($value)
 * @method static Builder|PermissionRole whereRoleId($value)
 * @method static Builder|PermissionRole whereUpdatedAt($value)
 */
class PermissionRole extends Pivot
{
    use HasFactory;

    protected $table = 'permission_role';

    protected $fillable = [
        'role_id',
        'permission_id'
    ];
}
