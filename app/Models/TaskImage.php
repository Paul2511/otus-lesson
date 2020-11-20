<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Factories\HasFactory
};
use Carbon\Carbon;

/**
 * App\Models\TaskImage
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $task_id
 * @property string $path_img
 * @method static Builder|TaskImage newModelQuery()
 * @method static Builder|TaskImage newQuery()
 * @method static Builder|TaskImage query()
 * @method static Builder|TaskImage whereCreatedAt($value)
 * @method static Builder|TaskImage whereId($value)
 * @method static Builder|TaskImage wherePathImg($value)
 * @method static Builder|TaskImage whereTaskId($value)
 * @method static Builder|TaskImage whereUpdatedAt($value)
 * @property-read Task|null $task
 */
class TaskImage extends Model
{
    use HasFactory;

    protected $table = 'task_images';

    protected $fillable = [
        'task_id',
        'path_img',
    ];

    public function task()
    {
        return $this->hasOne(Task::class);
    }
}
