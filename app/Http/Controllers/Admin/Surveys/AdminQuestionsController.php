<?php

namespace App\Http\Controllers\Admin\Surveys;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Survey;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Surveys\Repositories\EloquentQuestionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use View as ViewFacade;


class AdminQuestionsController extends AdminBaseController
{

    /**
     * @var EloquentQuestionRepository
     */
    private $eloquentQuestionRepository;

    public function __construct(EloquentQuestionRepository $eloquentQuestionRepository)
    {
        $this->eloquentQuestionRepository = $eloquentQuestionRepository;
    }

    public function index(Survey $survey)
    {
        ViewFacade::share(
            [
                'survey'    => $survey,
                'questions' => $this->eloquentQuestionRepository->searchBySurveyId($survey->id),
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
                'question' => $this->eloquentQuestionRepository->createNew(),
            ]
        );

        return view('admin.questions.edit');
    }

    public function store(Request $request, Survey $survey)
    {
        $question = $this->eloquentQuestionRepository->store($request->all(), $survey);

        return $this->showElementIfCreatedOrGoBack(
            $question->id ?? 0,
            function () use ($survey, $question) {
                return AdminRoutes::questionsShow($survey, $question);
            }
        );
    }

    public function show(Survey $survey, int $questionId): View
    {
        $question = $this->eloquentQuestionRepository->findBySurveyOrFail($survey, $questionId);

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
        $question = $this->eloquentQuestionRepository->findBySurveyOrFail($survey, $questionId);

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
        $question = $this->eloquentQuestionRepository->findBySurveyOrFail($survey, $questionId);
        $this->eloquentQuestionRepository->update($question, $request->all());

        return redirect(AdminRoutes::questionsEdit($survey, $question));
    }

    public function destroy(Survey $survey, int $questionId)
    {
        $question = $this->eloquentQuestionRepository->findBySurveyOrFail($survey, $questionId);
        $this->eloquentQuestionRepository->delete($question);

        return redirect(AdminRoutes::questionsIndex($survey));
    }

}
