<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'mobile_phone',
    ];

    public function user(){
    	$this->belongsTo(User::class);
    }

    public function promo_code(){
        $this->hasMany(PromoCodes::class)->using(PromoCodeUser::class);
    }

    public function subscriber(){
    	$this->hasMany(Subscriber::class);
    }

    public function category(){
    	$this->hasMany(Category::class)->using(CategoryUser::class);
    }

    public function blacklist(){
    	$this->hasMany(Blacklist::class);
    }

    public function setting(){
    	$this->hasMany(Setting::class);
    }

    public function message(){
    	$this->belongsToMany(Message::class)->using(MessageUser::class);
    }

    public function promotion_user(){
    	$this->belongsToMany(Promotion::class)->using(PromotionUser::class);
    }

    public function promotion_category(){
    	$this->belongsToMany(Category::class)->using(PromotionUser::class);
    }


}
