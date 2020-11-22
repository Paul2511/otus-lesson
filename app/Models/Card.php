<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Card
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property int $count_month
 * @property int $count_day
 * @property int $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Card extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'count_month',
        'count_day',
        'price',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'count_month' => 'integer',
        'count_day' => 'integer',
        'price' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'card_user');
    }
}
