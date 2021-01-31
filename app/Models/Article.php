<?php

namespace App\Models;

class Article extends Model
{
    protected $table = 'articles';

    const SORT = 100;

    protected $fillable = [
        'name',
        'sort',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
    ];
}
