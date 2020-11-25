<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $plan_id
 * @property integer $user_id
 * @property integer $owner_id
 * @property string $start_date
 * @property string $end_date
 * @property float $price
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Plan $plan
 * @property User $owner
 */
class PlanUser extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['plan_id', 'user_id', 'owner_id', 'start_date', 'end_date', 'price', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
