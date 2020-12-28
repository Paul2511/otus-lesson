<?php

namespace App\Http\Controllers\Sources;

use App\Policies\Permissions;
use App\Services\Resources\Resources;
use Illuminate\Support\Facades\Gate;
use View;

class OnlineStatisticController extends ResourceController
{
    public function view()
    {
        Gate::authorize(Permissions::VIEW_SOURCE, Resources::STATISTIC_ONLINE);
        View::share([
            'category_name' => 'statistic',
            'page_name' => 'online',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.statistic.online');
    }

}
