<?php

namespace App\Models;


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
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'plan_id', 'type_pay', 'name', 'email', 'phone', 'note', 'hash', 'status', 'price', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderNotes()
    {
        return $this->hasMany('App\Models\OrderNote');
    }
}
