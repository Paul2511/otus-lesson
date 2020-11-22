<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *   Class Category
	
	@package App\Models

	@property string $title
	@property int $id
	@property int $parent_id
	@property tinyInt $status
 */
		

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
    	'title',
    	'parent_id',
    	'status',
    ];

    public function user(){
    	$this->belongsToMany(User::class)->using(CategoryUser::class);
    }
}
