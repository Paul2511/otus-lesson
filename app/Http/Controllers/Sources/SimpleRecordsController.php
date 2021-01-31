<?php

namespace App\Http\Controllers\Sources;

use App\Policies\Permissions;
use App\Services\Records\RecordsService;
use App\Services\Resources\Resources;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SimpleRecordsGetRequest;
use View;

class SimpleRecordsController extends ResourceController
{

    private RecordsService $recordsService;

    public function __construct(RecordsService $recordsService)
    {
        $this->recordsService = $recordsService;
    }

    public function view()
    {
        Gate::authorize(Permissions::VIEW_SOURCE, Resources::SIMPLE_RECORDS);
               View::share([
            'category_name' => 'records',
            'page_name' => 'simple',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.records.simple');
    }

    public function records(SimpleRecordsGetRequest $request)
    {
        $this->authorize(Permissions::VIEW_SOURCE, Resources::SIMPLE_RECORDS);
        $records = $this->recordsService->getRecords($request->getFormData());
        return response()->json($records);
    }

}
