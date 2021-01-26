<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * App\Models\ResourceUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $resource_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Resource $resource
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceUser whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceUser whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceUser whereUserId($value)
 */
class ResourceUser extends BaseModel
{
    use HasFactory;
    protected $table = 'resource_user';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function resource(){
        return $this->belongsTo(Resource::class);
    }
}
