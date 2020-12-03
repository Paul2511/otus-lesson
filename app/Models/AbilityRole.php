<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\RoleUser
 *
 * @property int $id
 * @property int $ability_id
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|RoleUser newModelQuery()
 * @method static Builder|RoleUser newQuery()
 * @method static Builder|RoleUser query()
 * @method static Builder|RoleUser whereCreatedAt($value)
 * @method static Builder|RoleUser whereId($value)
 * @method static Builder|RoleUser whereRoleId($value)
 * @method static Builder|RoleUser whereUpdatedAt($value)
 * @method static Builder|RoleUser whereUserId($value)
 * @mixin \Eloquent
 */
class AbilityRole extends Pivot
{

}
