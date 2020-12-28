<?php

namespace App\Http\Controllers\Sources;

use App\Policies\Permissions;
use App\Services\Resources\Resources;
use Illuminate\Support\Facades\Gate;
use View;

class QuotasReportController extends ResourceController
{

    public function view()
    {
        Gate::authorize(Permissions::VIEW_SOURCE, Resources::REPORT_QUOTAS);
        View::share([
            'category_name' => 'reports',
            'page_name' => 'quotas',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.reports.quotas');
    }

}
