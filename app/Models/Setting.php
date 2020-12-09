<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Models
 */

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'status',
    ];

    public function user(){
    	$this->belongsToMany(User::class);
    }
}
