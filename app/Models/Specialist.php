<?php

namespace App\Models;

use App\States\Specialist\Classifier\SpecialistClassifier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

/**
 * @property int $id
 * @property int $user_id
 * @property SpecialistClassifier|null $classifier
 * @property int|null $specialization_id
 *
 * @method static Builder|Specialist whereClassifier($value)
 * @method static Builder|Specialist whereUserId($value)
 *
 * @property-read Collection|User           $user
 * @property-read Collection|Specialization $specialization
 * @mixin \Eloquent
 *
 */
class Specialist extends Model
{
    use HasStates;

    public $timestamps = false;

    protected $fillable = [
        'classifier', 'specialization_id', 'user_id'
    ];

    protected $casts = [
        'classifier'=>SpecialistClassifier::class
    ];

    protected $hidden = [
        'classifier'
    ];

    protected $appends = [
        'currentClassifier', 'specializationTitle'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function getSpecializationTitleAttribute()
    {
        $specialization = $this->specialization;
        return $specialization->title ?? '';
    }

    public function getCurrentClassifierAttribute()
    {
        return $this->classifier ? [
            'classifier'=>$this->classifier->getValue(),
            'label'=>$this->classifier->label()
        ] : null;
    }


}
