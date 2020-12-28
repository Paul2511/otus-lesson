<?php

namespace App\Http\Controllers\Sources;

use View;
use Illuminate\Support\Facades\Gate;
use App\Services\Resources\Resources;
use App\Policies\Permissions;
class StatReportController extends ResourceController
{

    public function view()
    {
        Gate::authorize(Permissions::VIEW_SOURCE, Resources::REPORT_STAT);
        View::share([
            'category_name' => 'reports', 'page_name' => 'stat',
            'has_scrollspy' => 0, 'scrollspy_offset' => '',
        ]);

        return view('pages.reports.stat');
    }


}
