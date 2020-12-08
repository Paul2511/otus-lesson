<?php

namespace App\Http\Controllers\Sources;
use App\Http\Controllers\Controller;
use View;

class BalanceReportController extends Controller
{
    public function __construct()
    {
    }
    public function __invoke()
    {
        View::share([
            'category_name' => 'reports',
            'page_name' => 'balance',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.reports.balance');
    }

}
