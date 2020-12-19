<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'data', 'user_id'];
    protected $table = "knowledges";
    public function creator(){
		return $this->belongsTo(User::class);    
    }
}
