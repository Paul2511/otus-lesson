<?php

namespace App\Models;


class Translation extends Model
{
    protected $fillable = [
        'entity_type',
        'entity_id',
        'locale',
        'key',
        'value',
    ];

    public function entity()
    {
        return $this->morphTo();
    }

}
