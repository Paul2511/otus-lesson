<?php

namespace App\Http\Controllers\Sources;
use App\Http\Controllers\Controller;
use View;

class ProcessedCallsReportController extends Controller
{
    public function __construct()
    {
    }
    public function __invoke()
    {
        View::share([
            'category_name' => 'reports',
            'page_name' => 'processed-calls',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.reports.processed-calls');
    }

}
