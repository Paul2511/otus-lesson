<?php

namespace App\Models\Admin\Categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    
    const STATUS_INACTIVE = 'STATUS_INACTIVE';
    const STATUS_ACTIVE = 'STATUS_ACTIVE';
}
