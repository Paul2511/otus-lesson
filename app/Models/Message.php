<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
    	'title',
        'message_text',
        'status',
    ];

    public function user_from(){
    	$this->belongsTo(User::class)->using(MessageUser::class);
    }

    public function user_to(){
    	$this->belongsTo(User::class)->using(MessageUser::class);
    }
}
