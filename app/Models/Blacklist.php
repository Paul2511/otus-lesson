<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *  Class Blacklist
	
	@package App\Models

	@property int $user_id
	@property int $banned_user_id

 */

class Blacklist extends Model
{

    protected $fillable = [
    	'user_id',
    	'banned_user_id',
    ];

    public function user(){
    	$this->belongsToMany(User::class);
    }
}
