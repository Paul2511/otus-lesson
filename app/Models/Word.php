<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dictionary_id',
        'value',
        'translation',
        'status',
    ];

    public function contexts()
    {
        return $this->hasMany('App\Models\Context');
    }

    public function dictionary()
    {
        return $this->belongsTo('App\Models\Dictionary');
    }
}
