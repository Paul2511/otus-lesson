<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\SearchContent
 *
 * @property string $title
 * @property string $content
 * @property string $entity_type
 * @property string $entity_id
 * @property string $path
 * @property int $weight
 * @method static \Illuminate\Database\Eloquent\Builder|SearchContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchContent whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchContent whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchContent wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchContent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchContent whereWeight($value)
 * @mixin \Eloquent
 */
class SearchContent extends BaseModel
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'entity_type',
        'entity_id',
        'path',
        'weight',
    ];

}
