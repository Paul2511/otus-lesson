<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Factories\HasFactory
};
use Carbon\Carbon;

/**
 * App\Models\CommentImage
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $comment_id
 * @property string $path_img
 * @method static Builder|CommentImage newModelQuery()
 * @method static Builder|CommentImage newQuery()
 * @method static Builder|CommentImage query()
 * @method static Builder|CommentImage whereCommentId($value)
 * @method static Builder|CommentImage whereCreatedAt($value)
 * @method static Builder|CommentImage whereId($value)
 * @method static Builder|CommentImage wherePathImg($value)
 * @method static Builder|CommentImage whereUpdatedAt($value)
 * @property-read Comment|null $comment
 */
class CommentImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'path_img'
    ];

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }
}
