<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\{
    Builder,
    Collection,
    Model,
    Factories\HasFactory
};


/**
 * App\Models\Column
 *
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static Builder|Column newModelQuery()
 * @method static Builder|Column newQuery()
 * @method static Builder|Column query()
 * @method static Builder|Column whereCreatedAt($value)
 * @method static Builder|Column whereId($value)
 * @method static Builder|Column whereTitle($value)
 * @method static Builder|Column whereUpdatedAt($value)
 * @method static find(int $int)
 */
class Column extends Model
{
    use HasFactory;

    protected $table = 'columns';

    public $timestamps = 'true';

    protected $fillable = [
        'title'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
