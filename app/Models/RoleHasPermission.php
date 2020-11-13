<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Factories\HasFactory
};
use Carbon\Carbon;

/**
 * App\Models\RoleHasPermission
 *
 * @property int $id
 * @property int $role_id
 * @property int $permissions_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RoleHasPermission newModelQuery()
 * @method static Builder|RoleHasPermission newQuery()
 * @method static Builder|RoleHasPermission query()
 * @method static Builder|RoleHasPermission whereCreatedAt($value)
 * @method static Builder|RoleHasPermission whereId($value)
 * @method static Builder|RoleHasPermission wherePermissionsId($value)
 * @method static Builder|RoleHasPermission whereRoleId($value)
 * @method static Builder|RoleHasPermission whereUpdatedAt($value)
 */
class RoleHasPermission extends Model
{
    use HasFactory;

    protected $table = 'role_has_permissions';

    protected $fillable = [
        'role_id',
        'permission_id'
    ];
}
