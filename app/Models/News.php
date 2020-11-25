<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property NewsCategory[] $newsCategories
 */
class News extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'slug', 'text', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function newsCategories(): BelongsToMany
    {
        return $this->belongsToMany(NewsCategory::class);
    }
}
