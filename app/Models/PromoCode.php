<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PromoCode
 * @package App\Models
 */

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
    	'promo_text',
    	'redeem_user_id',
    	'date_redeem',
    ];

    protected $casts = [
        'date_redeem' => 'datetime',
    ];

    function user(){
    	$this->belongsTo(User::class)->using(PromoCodeUser::class);
    }

    function user_redeemed(){
    	$this->belongsTo(User::class)->using(PromoCodeUser::class);
    }
}
