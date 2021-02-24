<?php

namespace App\Http\Controllers\PublicArea\Surveys;

use App\Http\Controllers\PublicArea\PublicBaseController;
use App\Models\Survey;
use App\Policies\Permission;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Surveys\SurveysService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use View as ViewFacade;

class PublicSurveysController extends PublicBaseController
{
    private string         $model = Survey::class;
    private SurveysService $surveysService;

    public function __construct(SurveysService $surveysService)
    {
        $this->surveysService = $surveysService;
    }

    public function index(): View
    {
        $this->authorize(Permission::VIEW_ANY, $this->model);

        $surveys = $this->surveysService->searchForCurrentUser();

        ViewFacade::share(compact('surveys'));

        return view('public.surveys.index');
    }

    public function survey(Survey $survey): View
    {
        $this->authorize(Permission::VIEW, $survey);

        ViewFacade::share(
            [
                'survey' => $survey,
            ]
        );

        return view('public.surveys.survey');
    }
}
