<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property string $text
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 * @property User $user
 */
class OrderNote extends Model
{
     /**
     * @var array
     */
    protected $fillable = ['order_id', 'user_id', 'text', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
