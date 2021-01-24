<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\States\Client\Classifier\ClientClassifier;
use Spatie\ModelStates\HasStates;
/**
 * @property int $id
 * @property int $user_id
 * @property ClientClassifier|null $classifier
 *
 * @method static Builder|Client whereClassifier($value)
 * @method static Builder|Client whereUserId($value)
 *
 * @property-read Collection|User           $user
 * @mixin \Eloquent
 *
 * @property-read Collection|Pet[] $pets
 */
class Client extends Model
{
    use HasStates;

    public $timestamps = false;

    protected $rememberCachePrefix = 'clients';


    protected $casts = [
        'classifier'=>ClientClassifier::class
    ];

    protected $fillable = [
        'classifier', 'user_id'
    ];

    protected $hidden = [
        'classifier'
    ];

    protected $appends = [
        'currentClassifier'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function getCurrentClassifierAttribute()
    {
        return [
            'classifier'=>$this->classifier->getValue(),
            'label'=>$this->classifier->label()
        ];
    }
}
