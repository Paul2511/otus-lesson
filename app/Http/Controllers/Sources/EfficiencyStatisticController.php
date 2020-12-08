<?php

namespace App\Http\Controllers\Sources;
use App\Http\Controllers\Controller;
use View;

class EfficiencyStatisticController extends Controller
{
    public function __construct()
    {
    }
    public function __invoke()
    {
        View::share([
            'category_name' => 'statistic',
            'page_name' => 'efficiency',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.statistic.efficiency');
    }

}
