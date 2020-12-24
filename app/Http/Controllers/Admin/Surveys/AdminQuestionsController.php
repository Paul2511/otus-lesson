<?php

namespace App\Http\Controllers\Admin\Surveys;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Question;
use App\Models\Survey;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Surveys\QuestionsService;
use App\Services\Surveys\Repositories\EloquentQuestionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use View as ViewFacade;


class AdminQuestionsController extends AdminBaseController
{

    private QuestionsService $questionsService;

    public function __construct(QuestionsService $questionsService)
    {
        $this->questionsService = $questionsService;
    }

    public function index(Survey $survey)
    {
        ViewFacade::share(
            [
                'survey'    => $survey,
                'questions' => $this->questionsService->eloquentQuestionRepository->searchBySurveyId($survey->id),
            ]
        );

        return view('admin.questions.index');
    }

    public function create(Survey $survey)
    {
        ViewFacade::share(
            [
                'formOpenOptions' =>
                    [
                        'url'    => AdminRoutes::questionsStore($survey),
                        'method' => 'POST',
                    ],

                'survey'   => $survey,
                'question' => new Question,
            ]
        );

        return view('admin.questions.edit');
    }

    public function store(Request $request, Survey $survey)
    {
        $question = $this->questionsService->createFromArray($request->all(), $survey);

        return $this->showElementIfCreatedOrGoBack(
            $question->id ?? 0,
            function () use ($survey, $question) {
                return AdminRoutes::questionsShow($survey, $question);
            }
        );
    }

    public function show(Survey $survey, int $questionId): View
    {
        $question = $this->questionsService->eloquentQuestionRepository->findBySurveyOrFail($survey, $questionId);

        ViewFacade::share(
            [
                'question' => $question,
                'survey'   => $survey,
            ]
        );

        return view('admin.questions.show');
    }

    public function edit(Survey $survey, int $questionId)
    {
        $question = $this->questionsService->eloquentQuestionRepository->findBySurveyOrFail($survey, $questionId);

        ViewFacade::share(
            [
                'question' => $question,
                'survey'   => $survey,

                'formOpenOptions' =>
                    [
                        'url'    => AdminRoutes::questionsUpdate($survey, $question),
                        'method' => 'PUT',
                    ],
            ]
        );

        return view('admin.questions.edit');
    }

    public function update(Request $request, Survey $survey, int $questionId)
    {
        $question = $this->questionsService->updateByIdFromArray($survey, $questionId, $request->all());

        return redirect(AdminRoutes::questionsEdit($survey, $question));
    }

    public function destroy(Survey $survey, int $questionId)
    {
        $question = $this->questionsService->eloquentQuestionRepository->findBySurveyOrFail($survey, $questionId);
        $this->questionsService->eloquentQuestionRepository->delete($question);

        return redirect(AdminRoutes::questionsIndex($survey));
    }

}
