<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function creator(){
    	return $this->belongsTo(User::class);
    }
    public function users(){
    	return $this->belongsToMany(User::class);
    }
    public function todos(){
    	return $this->hasMany(Todo::class);
    }
    public function comments(){
    	return $this->hasMany(Comment::class);
    }
}
