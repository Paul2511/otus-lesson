<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Watson\Rememberable\Rememberable;

class Model extends EloquentModel
{
    use HasFactory, Rememberable;

}
