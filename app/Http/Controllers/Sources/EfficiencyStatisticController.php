<?php

namespace App\Http\Controllers\Sources;

use App\Policies\Permissions;
use App\Services\Resources\Resources;
use Illuminate\Support\Facades\Gate;
use View;

class EfficiencyStatisticController extends ResourceController
{

    public function view()
    {
        Gate::authorize(Permissions::VIEW_SOURCE, Resources::STATISTIC_EFFICIENCY);
        View::share([
            'category_name' => 'statistic',
            'page_name' => 'efficiency',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.statistic.efficiency');
    }

}
