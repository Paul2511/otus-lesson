<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Post
 *
 * @property string $id
 * @property string $slug
 * @property int $priority
 * @property string $name_view
 * @property string $name_raw
 * @property string $text_view
 * @property string $text_raw
 * @property string $source_link
 * @property string $source_label
 * @property int $status
 * @property string $creator_id
 * @property string $redactor_id
 * @property int $counter_like
 * @property int $counter_dislike
 * @property int $counter_favorite
 * @property int $counter_views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\User $redactor
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCounterDislike($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCounterFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCounterLike($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCounterViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereNameRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereNameView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereRedactorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSourceLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSourceLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTextRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTextView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends BaseModel
{
    use HasFactory, UseUuid;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'priority',
        'name_view',
        'name_raw',
        'text_view',
        'text_raw',
        'source_link',
        'source_label',
        'status',
        'creator_id',
        'redactor_id',
    ];

    /**
     * Список доступных статусов сущности
     *
     * @return array
     */
    public static function getStatuses() {
        return [
            self::STATUS_INACTIVE,
            self::STATUS_MODERATION,
            self::STATUS_ACTIVE,
            self::STATUS_DELETED_BY_OWNER,
            self::STATUS_DELETED_BY_ADMIN,
        ];
    }

    /**
     * Получить создателя поста
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Получить редактора поста
     */
    public function redactor()
    {
        return $this->belongsTo(User::class, 'redactor_id');
    }

    /**
     * Получить теги поста
     */
    public function tags()
    {
        return $this
            ->belongsToMany(Tag::class, 'tag_contents', 'entity_id', 'tag_id')
            ->wherePivot('entity_type', TagContent::TYPE_POST);
    }
}
