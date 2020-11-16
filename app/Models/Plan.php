<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $descriprion
 * @property float $price
 * @property int $duration
 * @property boolean $mail_notification
 * @property string $created_at
 * @property string $updated_at
 * @property Order[] $orders
 * @property PlanUser[] $planUsers
 */
class Plan extends Model
{
    use HasFactory;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title', 'code', 'descriprion', 'price', 'duration', 'mail_notification', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planUsers()
    {
        return $this->hasMany('App\Models\PlanUser');
    }
}
