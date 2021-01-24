<?php

namespace App\Models;

use App\Models\Casts\PhoneCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Traits\HasComments;
use Spatie\ModelStates\HasStates;
use App\States\Lead\Type\LeadType;
use App\States\Lead\Status\LeadStatus;
/**
 * App\Models\Lead
 *
 * @property int $id
 * @property LeadType|null $type
 * @property LeadStatus $status
 * @property PhoneCast|null $internal_phone
 * @property PhoneCast|null $external_phone
 * @property int $user_id
 * @property int|null $manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Lead newModelQuery()
 * @method static Builder|Lead newQuery()
 * @method static Builder|Lead query()
 * @method static Builder|Lead whereCreatedAt($value)
 * @method static Builder|Lead whereExternalPhone($value)
 * @method static Builder|Lead whereId($value)
 * @method static Builder|Lead whereInternalPhone($value)
 * @method static Builder|Lead whereManagerId($value)
 * @method static Builder|Lead whereStatus($value)
 * @method static Builder|Lead whereType($value)
 * @method static Builder|Lead whereUpdatedAt($value)
 * @method static Builder|Lead whereUserId($value)
 * @mixin \Eloquent
 *
 * @property-read Collection|User   $user
 * @property-read Collection|User   $manager
 *
 */
class Lead extends Model
{
    use HasFactory;
    use HasComments;
    use HasStates;

    protected $fillable = [
        'type', 'status', 'internal_phone', 'external_phone', 'user_id', 'manager_id'
    ];

    protected $casts = [
        'internal_phone' => PhoneCast::class,
        'external_phone' => PhoneCast::class,
        'type' => LeadType::class,
        'status' => LeadStatus::class
    ];

    protected $hidden = [
        'type', 'status'
    ];

    protected $appends = [
        'currentType', 'currentStatus'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id')->withDefault();
    }

    public function getCurrentTypeAttribute()
    {
        return [
            'type'=>$this->type->getValue(),
            'label'=>$this->type->label()
        ];
    }

    public function getCurrentStatusAttribute()
    {
        return [
            'status'=>$this->status->getValue(),
            'label'=>$this->status->label()
        ];
    }
}
