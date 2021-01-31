<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'name',
        'comment',
        'restaurant_id',
    ];

    /**
     * @return HasMany
     */
    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class);
    }
}
