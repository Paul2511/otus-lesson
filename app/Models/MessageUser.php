<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class MessageUser
 * @package App\Models
 */

class MessageUser extends Pivot
{
    use HasFactory;
}
