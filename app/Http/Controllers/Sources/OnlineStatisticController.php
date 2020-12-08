<?php

namespace App\Http\Controllers\Sources;
use App\Http\Controllers\Controller;
use View;

class OnlineStatisticController extends Controller
{
    public function __construct()
    {
    }
    public function __invoke()
    {
        View::share([
            'category_name' => 'statistic',
            'page_name' => 'online',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.statistic.online');
    }

}
