<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Subsriber
 * @package App\Models
 */

class Subsriber extends Model
{

    protected $fillable = [
    	'user_id',
    	'subscriber_id',
    	'status',
    ];

    public function user(){
    	$this->belongsToMany(User::class);
    }
}
