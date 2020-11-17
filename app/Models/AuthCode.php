<?php

namespace App\Models;

use App\Casts\Phone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\AuthCode
 *
 * @property int $id
 * @property string $phone
 * @property string $hash
 * @property string|null $code
 * @property string $timeout
 * @property int $attempt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|AuthCode newModelQuery()
 * @method static Builder|AuthCode newQuery()
 * @method static Builder|AuthCode query()
 * @method static Builder|AuthCode whereAttempt($value)
 * @method static Builder|AuthCode whereCode($value)
 * @method static Builder|AuthCode whereCreatedAt($value)
 * @method static Builder|AuthCode whereHash($value)
 * @method static Builder|AuthCode whereId($value)
 * @method static Builder|AuthCode wherePhone($value)
 * @method static Builder|AuthCode whereTimeout($value)
 * @method static Builder|AuthCode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AuthCode extends Model
{

    protected $fillable = [
        'phone', 'code'
    ];

    protected $hidden = [
        'hash'
    ];

    protected $casts = [
        'timeout' => 'datetime',
        'phone' => Phone::class
    ];
}
