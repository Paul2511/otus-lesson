<?php

namespace App\Http\Controllers\Sources;
use App\Http\Controllers\Controller;
use View;

class DashboardController extends Controller
{
    public function __construct()
    {
    }
    public function __invoke()
    {
        View::share([
            'category_name' => 'dashboard',
            'page_name' => 'home',
            'has_scrollspy' => 1,
            'scrollspy_offset' => 140,
        ]);
        return view('dashboard');
    }

}
