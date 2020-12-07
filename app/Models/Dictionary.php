<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function words()
    {
        return $this->hasMany('App\Models\Word');
    }

    public function contexts()
    {
        return $this->hasManyThrough('App\Models\Context', 'App\Models\Word');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
