<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'word_id',
        'value',
        'prefix',
        'postfix',
    ];

    public function word()
    {
        return $this->belongsTo('App\Models\Word');
    }
}
