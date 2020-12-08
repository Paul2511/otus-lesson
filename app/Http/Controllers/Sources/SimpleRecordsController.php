<?php

namespace App\Http\Controllers\Sources;
use App\Http\Controllers\Controller;
use View;

class SimpleRecordsController extends Controller
{
    public function __construct()
    {
    }
    public function __invoke()
    {
        View::share([
            'category_name' => 'records',
            'page_name' => 'simple',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.records.simple');
    }

}
