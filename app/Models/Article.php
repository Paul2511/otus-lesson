<?php

namespace App\Models;

class Article extends Model
{

    const SORT = 100;

    protected $fillable = [
        'name',
        'slug',
        'sort',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
    ];
}
