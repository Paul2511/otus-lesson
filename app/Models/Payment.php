<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * App\Models\Payment
 *
 * @property int $id
 * @property string $value
 * @property Carbon $billed
 * @property Carbon $payed
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Payment newModelQuery()
 * @method static Builder|Payment newQuery()
 * @method static Builder|Payment query()
 * @method static Builder|Payment whereBilled($value)
 * @method static Builder|Payment whereCreatedAt($value)
 * @method static Builder|Payment whereId($value)
 * @method static Builder|Payment wherePayed($value)
 * @method static Builder|Payment whereStatus($value)
 * @method static Builder|Payment whereUpdatedAt($value)
 * @method static Builder|Payment whereValue($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use HasFactory;

    const STATUS_BILLED = 10;
    const STATUS_PAYED = 20;
    const STATUS_PENDING = 30;
    const STATUS_REFUND = 40;
    const STATUS_CANCELED = 50;

    protected $fillable = [
        'value',
        'billed',
        'payed',
        'status',
    ];

    protected $dates = [
        'billed',
        'payed',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class)
            ->using(PaymentService::class);
    }
}
