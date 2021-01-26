<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Collection,
    Factories\HasFactory
};
use Carbon\Carbon;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereTitle($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @method static paginate()
 * @method static findOrFail(int $id)
 * @method static create(array $data)
 * @method static where(string $string, string $title)
 * @property-read Collection|Role[] $permissions
 * @property-read int|null $permissions_count
 */
class Role extends Model
{
    use HasFactory;

    const ADMIN_ROLE = 'Admin';
    const USER_ROLE = 'User';

    protected $fillable = [
        'title'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->using(PermissionRole::class);
    }
}
