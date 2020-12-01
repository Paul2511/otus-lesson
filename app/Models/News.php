<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\News
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property string $picture
 * @property int $status
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|News newModelQuery()
 * @method static Builder|News newQuery()
 * @method static Builder|News query()
 * @method static Builder|News whereCreatedAt($value)
 * @method static Builder|News whereId($value)
 * @method static Builder|News wherePicture($value)
 * @method static Builder|News whereSlug($value)
 * @method static Builder|News whereStatus($value)
 * @method static Builder|News whereText($value)
 * @method static Builder|News whereTitle($value)
 * @method static Builder|News whereUpdatedAt($value)
 * @method static Builder|News whereUserId($value)
 * @mixin Eloquent
 */
class News extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 20;
}
