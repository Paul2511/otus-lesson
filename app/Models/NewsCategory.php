<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property News[] $news
 */
class NewsCategory extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['title', 'slug', 'description', 'created_at', 'updated_at'];

    /**
     * @return BelongsToMany
     */
    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class);
    }
}
