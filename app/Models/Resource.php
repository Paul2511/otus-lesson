<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Resource
 *
 * @property int $id
 * @property string $full_name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource query()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ResourceUser[] $resource_user
 * @property-read int|null $resource_user_count
 */
class Resource extends BaseModel
{
    use HasFactory;

    public function resource_user(){
        return $this->hasMany(ResourceUser::class);
    }
}


