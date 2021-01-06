<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Casts\AvatarCast;
use Watson\Rememberable\Rememberable;
use App\Events\UserDetail\UserDetailUpdated;

/**
 * App\Models\UserDetail
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $lastname
 * @property string|null $firstname
 * @property string|null $middlename
 * @property string|null $classifier
 * @property int|null $specialization_id
 * @property mixed|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|UserDetail newModelQuery()
 * @method static Builder|UserDetail newQuery()
 * @method static Builder|UserDetail query()
 * @method static Builder|UserDetail whereAvatar($value)
 * @method static Builder|UserDetail whereClassifier($value)
 * @method static Builder|UserDetail whereCreatedAt($value)
 * @method static Builder|UserDetail whereFirstname($value)
 * @method static Builder|UserDetail whereId($value)
 * @method static Builder|UserDetail whereLastname($value)
 * @method static Builder|UserDetail whereMiddlename($value)
 * @method static Builder|UserDetail whereSpecializationId($value)
 * @method static Builder|UserDetail whereUpdatedAt($value)
 * @method static Builder|UserDetail whereUserId($value)
 * @method static Builder|UserDetail remember($seconds, $key=null)
 * @method static Builder|UserDetail flushCache($key)
 * @mixin \Eloquent
 *
 * @method static Builder|UserDetail        clientTarget()
 * @method static Builder|UserDetail        specAllowed()
 * @property-read Collection|User           $user
 * @property-read Collection|Specialization $specialization
 */
class UserDetail extends BaseModel
{
    use HasFactory;
    use Rememberable;

    const CLASSIFIER_CLIENT_TARGET = 'client_target';
    const CLASSIFIER_CLIENT_SPAM = 'client_spam';
    const CLASSIFIER_CLIENT_OFF = 'client_off';
    const CLASSIFIER_CLIENT_FAR = 'client_far';
    const CLASSIFIER_CLIENT_OTHER = 'client_other';

    const CLASSIFIER_SPEC_ALLOWED = 'spec_allowed';
    const CLASSIFIER_SPEC_NOT_ALLOWED = 'spec_not_allowed';

    protected $rememberCachePrefix = 'userDetails';

    public $commentType = 'userDetail';

    public static $modelName = 'userDetail';

    protected $fillable = [
        'lastname', 'firstname', 'middlename', 'classifier', 'specialization_id', 'avatar'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'avatar' => AvatarCast::class
    ];

    protected $dispatchesEvents = [
        'updated'=>UserDetailUpdated::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function specialization()
    {
        return $this->belongsTo(Specialization::class)->withDefault();
    }


    public function scopeClientTarget(Builder $query)
    {
        return $query->where('classifier', self::CLASSIFIER_CLIENT_TARGET);
    }


    public function scopeSpecAllowed(Builder $query)
    {
        return $query->where('classifier', self::CLASSIFIER_SPEC_ALLOWED);
    }


}
