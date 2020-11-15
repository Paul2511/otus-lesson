<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

/**
 * App\Models\CompanyUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $inn
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CompanyUser newModelQuery()
 * @method static Builder|CompanyUser newQuery()
 * @method static Builder|CompanyUser query()
 * @method static Builder|CompanyUser whereCreatedAt($value)
 * @method static Builder|CompanyUser whereId($value)
 * @method static Builder|CompanyUser whereInn($value)
 * @method static Builder|CompanyUser whereUpdatedAt($value)
 * @method static Builder|CompanyUser whereUserId($value)
 * @mixin \Eloquent
 */
class CompanyUser extends Pivot
{

}
