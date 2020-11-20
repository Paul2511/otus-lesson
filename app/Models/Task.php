<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\{
    Model,
    Builder,
    Collection,
    Factories\HasFactory,
};

/**
 * App\Models\Task
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $column_id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property mixed $watcher
 * @property string|null $deleted_at
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static Builder|Task query()
 * @method static Builder|Task whereColumnId($value)
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereDeletedAt($value)
 * @method static Builder|Task whereDescription($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereTitle($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @method static Builder|Task whereUserId($value)
 * @method static Builder|Task whereWatcher($value)
 * @property-read Collection|\App\Models\Column[] $column
 * @property-read int|null $column_count
 * @property-read Collection|\App\Models\User[] $owner
 * @property-read int|null $owner_count
 */
class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'column_id',
        'user_id',
        'title',
        'description',
        'watcher'
    ];

    protected $casts = [
      'watcher' => 'array'
    ];

    public function column()
    {
        return $this->belongsToMany(Column::class);
    }

    public function owner()
    {
        return $this->belongsToMany(User::class);
    }
}
