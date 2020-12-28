<?php

namespace App\Http\Controllers\Sources;

use View;

class DashboardController extends ResourceController
{
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
