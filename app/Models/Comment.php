<?php

namespace App\Models;
use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Factories\HasFactory
};
use Carbon\Carbon;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $task_id
 * @property int $user_id
 * @property string $text
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereTaskId($value)
 * @method static Builder|Comment whereText($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment whereUserId($value)
 * @property-read Task|null $task
 * @property-read User|null $user
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'text'
    ];

    public function task()
    {
        return $this->hasOne(Task::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
