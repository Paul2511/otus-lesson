<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
     * @var array
     */
    protected $fillable = ['title', 'code', 'description', 'price', 'duration', 'mail_notification', 'created_at', 'updated_at'];

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany
     */
    public function planUsers(): HasMany
    {
        return $this->hasMany(PlanUser::class);
    }
}
