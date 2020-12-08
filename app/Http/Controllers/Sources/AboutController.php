<?php

namespace App\Http\Controllers\Sources;
use App\Http\Controllers\Controller;
use View;

class AboutController extends Controller
{
    public function __construct()
    {
    }
    public function __invoke()
    {
        View::share([
            'category_name' => 'about',
            'page_name' => 'about_us',
            'has_scrollspy' => 1,
            'scrollspy_offset' => 140,
        ]);
        return view('about');
    }

}
