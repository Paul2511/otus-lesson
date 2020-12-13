<?php

namespace App\Http\Controllers\Admin\Surveys;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Survey;
use App\Policies\Permission;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Surveys\Repositories\EloquentSurveyRepository;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use View as ViewFacade;


class AdminSurveysController extends AdminBaseController
{
    private $model = Survey::class;

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
        $this->authorize(Permission::VIEW_ANY, $this->model);
        $user = $this->getCurrentUser();

        ViewFacade::share(
            [
                'surveys'   => $this->eloquentSurveyRepository->searchForCurrentUser(),
                'user'      => $user,
                'canCreate' => $user->can(Permission::CREATE, $this->model),
            ]
        );

        return view('admin.surveys.index');
    }

    public function show(Survey $survey)
    {
        $this->authorize(Permission::VIEW, $survey);

        ViewFacade::share(
            [
                'survey'    => $survey,
                'canUpdate' => $this->getCurrentUser()->can(Permission::UPDATE, $survey),
            ]
        );

        return view('admin.surveys.show');
    }

    public function edit(Survey $survey): View
    {
        $this->authorize(Permission::UPDATE, $survey);

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
        $this->authorize(Permission::CREATE, $this->model);

        ViewFacade::share(
            [
                'formOpenOptions' =>
                    [
                        'url'    => AdminRoutes::surveysStore(),
                        'method' => 'POST',
                    ],

                'survey' => new Survey,
            ]
        );

        return view('admin.surveys.edit');
    }

    public function store(Request $request)
    {
        $this->authorize(Permission::CREATE, $this->model);

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
        $this->authorize(Permission::UPDATE, $survey);

        $this->eloquentSurveyRepository->update($survey, $request->all());

        return redirect(AdminRoutes::surveysEdit($survey));
    }

    public function destroy(Survey $survey)
    {
        $this->authorize(Permission::DELETE, $survey);

        $this->eloquentSurveyRepository->delete($survey);

        return redirect(AdminRoutes::surveysIndex());
    }

}
