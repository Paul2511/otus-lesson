<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ["name", "last_name", "patronymic", "interest_status", "email", "addres", "phone", "wishes", "complaints", "selected_service", "user_id"];
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
