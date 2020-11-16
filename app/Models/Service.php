<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $specialist_uuid
 * @property string $service_uuid
 * @property int $sent_fms
 * @property string $rnr_date
 * @property string $inbox_num
 * @property int $rnr_status
 * @property string $rnr_ready
 * @property string $rnr_recieved
 * @property string $invite_sent
 * @property int $invite_status
 * @property string $invite_po
 * @property string $invite_recieved
 * @property string $visa_sent
 * @property int $visa_status
 * @property string $visa_po
 * @property string $visa_recieved
 * @property int $specialist_status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Company $specialist
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service where1cServiceUuid($value)
 * @method static Builder|Service where1cSpecialistUuid($value)
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereInboxNum($value)
 * @method static Builder|Service whereInvitePo($value)
 * @method static Builder|Service whereInviteRecieved($value)
 * @method static Builder|Service whereInviteSent($value)
 * @method static Builder|Service whereInviteStatus($value)
 * @method static Builder|Service whereRnrDate($value)
 * @method static Builder|Service whereRnrReady($value)
 * @method static Builder|Service whereRnrRecieved($value)
 * @method static Builder|Service whereRnrStatus($value)
 * @method static Builder|Service whereSentFms($value)
 * @method static Builder|Service whereSpecialistStatus($value)
 * @method static Builder|Service whereUpdatedAt($value)
 * @method static Builder|Service whereVisaPo($value)
 * @method static Builder|Service whereVisaRecieved($value)
 * @method static Builder|Service whereVisaSent($value)
 * @method static Builder|Service whereVisaStatus($value)
 * @mixin \Eloquent
 */
class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dates = [
        'rnr_date',
        'rnr_ready',
        'rnr_recieved',
        'invite_sent',
        'invite_po',
        'invite_recieved',
        'visa_sent',
        'visa_po',
        'visa_recieved',
    ];

    public function specialist()
    {
        return $this->belongsTo(Company::class, 'specialist_uuid');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'service_uuid')
            ->using(DocumentService::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'service_uuid')
            ->using(PaymentService::class);
    }

    public function isPassed()
    {
        return $this->specialist_status == ServiceStatus::STATUS_PASSED;
    }

}
