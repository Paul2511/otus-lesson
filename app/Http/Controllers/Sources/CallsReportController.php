<?php


namespace App\Http\Controllers\Sources;

use App\Http\Requests\ReportCallsGetRequest;
use App\Jobs\ReportCallsJob;
use App\Policies\Permissions;
use App\Services\Reports\ReportCallsService;
use App\Services\Reports\Repositories\EloquentModRecordsRepository;
use App\Services\Resources\Resources;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;

class CallsReportController extends ResourceController
{
    /**
     * @var ReportCallsService
     */
    private ReportCallsService $reportCallsService;

    public function __construct(ReportCallsService $reportCallsService)
    {
        $this->reportCallsService = $reportCallsService;
    }

    public function view()
    {
        Gate::authorize(Permissions::VIEW_SOURCE, Resources::REPORT_CALLS);
        View::share([
            'category_name' => 'reports',
            'page_name' => 'calls',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.reports.calls');
    }

    public function build(ReportCallsGetRequest $request):JsonResponse
    {
        $this->authorize(Permissions::VIEW_SOURCE, Resources::REPORT_CALLS);
        ReportCallsJob::dispatch($request->getFormData());
        return response()->json('ok');
    }
}
