<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class PromoCodeUser
 * @package App\Models
 */

class PromoCodeUser extends Pivot
{
    use HasFactory;
}
