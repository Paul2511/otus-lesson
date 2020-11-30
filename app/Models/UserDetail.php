<?php

namespace App\Models;

use App\Helpers\UtilsHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Casts\AvatarCast;

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

    const CLASSIFIER_CLIENT_TARGET = 'client_target';
    const CLASSIFIER_CLIENT_SPAM = 'client_spam';
    const CLASSIFIER_CLIENT_OFF = 'client_off';
    const CLASSIFIER_CLIENT_FAR = 'client_far';
    const CLASSIFIER_CLIENT_OTHER = 'client_other';

    const CLASSIFIER_SPEC_ALLOWED = 'spec_allowed';
    const CLASSIFIER_SPEC_NOT_ALLOWED = 'spec_not_allowed';

    private static array $classifierClientLabels;

    private static array $classifierSpecLabels;

    public $commentType = 'userDetail';

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


    protected $appends = [
        'fio', 'shortFio', 'displayName'
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


    /**
     * Возвращает полное ФИО
     */
    public function getFioAttribute(): string
    {
        $lastName = $this->lastname?$this->lastname.' ':'';
        $firstName = $this->firstname?$this->firstname.' ':'';
        $middleName = $this->middlename ?? '';
        return trim($lastName . $firstName . $middleName);
    }

    public function getDisplayNameAttribute(): string
    {
        $lastName = $this->lastname?$this->lastname.' ':'';
        $firstName = $this->firstname?$this->firstname.' ':'';
        $result = trim($lastName . $firstName);

        if (empty($result)) {
            $user = $this->user;
            $result = ucfirst($user->getRoleLabelAttribute());
        }

        return $result;
    }

    /**
     * Возвращает сокращенное ФИО: Иванов И.И.
     */
    public function getShortFioAttribute(): string
    {
        $firstName = $this->firstname ? mb_substr($this->firstname, 0, 1).'.' : null;
        $middleName = $this->middlename ? mb_substr($this->middlename, 0, 1).'.' : null;
        $fio = trim(implode(' ', [$this->lastname, $firstName, $middleName]));
        $fio = preg_replace('~\s+~', ' ', $fio);

        return $fio ? $fio : null;
    }


    public static function classifierClientLabels(): array
    {
        if (isset(self::$classifierClientLabels)) return self::$classifierClientLabels;
        return self::$classifierClientLabels = UtilsHelper::getLangLabels(static::class, ['classifier', 'client']);
    }

    public static function classifierSpecLabels(): array
    {
        if (isset(self::$classifierSpecLabels)) return self::$classifierSpecLabels;
        return self::$classifierSpecLabels = UtilsHelper::getLangLabels(static::class, ['classifier', 'spec']);
    }
}
