<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $plan_id
 * @property string $type_pay
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $note
 * @property string $hash
 * @property string $status
 * @property float $price
 * @property string $created_at
 * @property string $updated_at
 * @property Plan $plan
 * @property User $user
 * @property OrderNote[] $orderNotes
 */
class Order extends Model
{
     /**
     * @var array
     */
    protected $fillable = ['user_id', 'plan_id', 'type_pay', 'name', 'email', 'phone', 'note', 'hash', 'status', 'price', 'created_at', 'updated_at'];

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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function orderNotes(): HasMany
    {
        return $this->hasMany(OrderNote::class);
    }
}
