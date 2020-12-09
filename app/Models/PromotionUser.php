<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class PromotionUser
 * @package App\Models
 */

class PromotionUser extends Pivot
{
    use HasFactory;
}
