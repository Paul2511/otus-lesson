<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
    	'title',
    	'text',
    	'validate',
    	'status'
    ];

    protected $casts = [
    	'validate' = 'datetime',
    ];

    public function user(){
    	$this->belongsTo(User::class)->using(PromotionUser::class);
    }
}
