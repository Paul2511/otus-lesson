<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 *
 * @method static Builder|Manager whereUserId($value)
 *
 * @property-read Collection|User           $user
 * @mixin \Eloquent
 *
 */
class Manager extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
