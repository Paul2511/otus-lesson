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
 * App\Models\Permission
 *
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission query()
 * @method static Builder|Permission whereCreatedAt($value)
 * @method static Builder|Permission whereId($value)
 * @method static Builder|Permission whereTitle($value)
 * @method static Builder|Permission whereUpdatedAt($value)
 * @method static paginate()
 * @method static findOrFail(int $id)
 * @method static create(array $data)
 * @property-read Collection|Permission[] $roles
 * @property-read int|null $roles_count
 */
class Permission extends Model
{
    use HasFactory;

    const VIEW = 'view';
    const WRITE = 'write';
    const EDIT = 'edit';
    const DELETE = 'delete';
    const ADMIN = 'admin';

    protected $fillable = [
        'title'
    ];

}
