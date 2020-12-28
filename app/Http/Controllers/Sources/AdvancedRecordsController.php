<?php

namespace App\Http\Controllers\Sources;

use App\Policies\Permissions;
use App\Services\Resources\Resources;
use Illuminate\Support\Facades\Gate;
use View;
class AdvancedRecordsController extends ResourceController
{

    public function view()
    {
        Gate::authorize(Permissions::VIEW_SOURCE, Resources::ADVANCED_RECORDS);
        View::share([
            'category_name' => 'records',
            'page_name' => 'advanced',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.reports.balance');
    }
}
