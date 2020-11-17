<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\TagContent
 *
 * @property string $tag_id
 * @property string $entity_type
 * @property string $entity_id
 * @property-read \App\Models\Tag $tag
 * @method static \Illuminate\Database\Eloquent\Builder|TagContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|TagContent whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagContent whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagContent whereTagId($value)
 * @mixin \Eloquent
 */
class TagContent extends BasePivot
{
    use HasFactory;

    public $timestamps = false;

    const TYPE_USER = 10;
    const TYPE_POST = 20;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'tag_id',
        'entity_type',
        'entity_id',
    ];

    /**
     * Получить тег контента
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
