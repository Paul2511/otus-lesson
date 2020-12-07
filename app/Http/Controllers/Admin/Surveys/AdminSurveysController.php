<?php

namespace App\Http\Controllers\Admin\Surveys;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Survey;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Surveys\Repositories\EloquentSurveyRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use View as ViewFacade;


class AdminSurveysController extends AdminBaseController
{
    /**
     * @var EloquentSurveyRepository
     */
    private $eloquentSurveyRepository;

    public function __construct(EloquentSurveyRepository $eloquentSurveyRepository)
    {
        $this->eloquentSurveyRepository = $eloquentSurveyRepository;
    }

    public function index(): View
    {
        // TODO: Добавить работу с текущим пользователем

        ViewFacade::share(
            [
                'surveys' => $this->eloquentSurveyRepository->searchByUserId(1, static::DEFAULT_PAGE_SIZE),
            ]
        );

        return view('admin.surveys.index');
    }

    public function show(Survey $survey)
    {
        ViewFacade::share(
            [
                'survey' => $survey,
            ]
        );

        return view('admin.surveys.show');
    }

    public function edit(Survey $survey): View
    {
        ViewFacade::share(
            [
                'formOpenOptions' =>
                    [
                        'url'    => AdminRoutes::surveysUpdate($survey),
                        'method' => 'PUT',
                    ],
                'survey'          => $survey,
            ]
        );

        return view('admin.surveys.edit');
    }

    public function create()
    {
        ViewFacade::share(
            [
                'formOpenOptions' =>
                    [
                        'url'    => AdminRoutes::surveysStore(),
                        'method' => 'POST',
                    ],

                'survey' => $this->eloquentSurveyRepository->createNew(),
            ]
        );

        return view('admin.surveys.edit');
    }

    public function store(Request $request)
    {
        $survey = $this->eloquentSurveyRepository->store($request->all());

        return $this->showElementIfCreatedOrGoBack(
            $survey->id ?? 0,
            function () use ($survey) {
                return AdminRoutes::surveysShow($survey);
            }
        );
    }

    public function update(Request $request, Survey $survey)
    {
        $this->eloquentSurveyRepository->update($survey, $request->all());

        return redirect(AdminRoutes::surveysEdit($survey));
    }

    public function destroy(Survey $survey)
    {
        $this->eloquentSurveyRepository->delete($survey);

        return redirect(AdminRoutes::surveysIndex());
    }

}
