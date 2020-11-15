<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\PaymentService
 *
 * @property int $id
 * @property int $payment_id
 * @property string $service_uuid
 * @method static Builder|PaymentService newModelQuery()
 * @method static Builder|PaymentService newQuery()
 * @method static Builder|PaymentService query()
 * @method static Builder|PaymentService where1cServiceUuid($value)
 * @method static Builder|PaymentService whereId($value)
 * @method static Builder|PaymentService wherePaymentId($value)
 * @mixin \Eloquent
 */
class PaymentService extends Pivot
{

}
