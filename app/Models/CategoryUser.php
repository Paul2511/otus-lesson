<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class CategoryUser
	
	@package App\Models

	@property string $title
	@property int $user_id
	@property int $category_id
	@property tinyInt $status
 */

class CategoryUser extends Pivot
{
    use HasFactory;
}
