<?php

namespace App\Http\Controllers\Admin\Survey;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Survey;
use App\Services\Routes\Provider\AdminSurveysRoutes;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;


class AdminSurveyQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Survey $survey
     */
    public function index(Survey $survey)
    {
        $questions = Question::whereSurveyId($survey->id)->paginate(8);

        return view('admin.questions.index', compact('survey', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Survey $survey
     */
    public function create(Survey $survey)
    {
        $formOpenOptions = [
            'url'    => route(AdminSurveysRoutes::QUESTIONS_STORE, $survey),
            'method' => 'POST',
        ];

        $question = new Question();

        return view('admin.questions.edit', compact('survey', 'question', 'formOpenOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Survey                   $survey
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request, Survey $survey)
    {
        $question = new Question($request->all());
        $question->survey()->associate($survey);
        $question->save();

        if ($question->id ?? false) {
            return redirect(route(AdminSurveysRoutes::QUESTIONS_SHOW, [$survey, $question]));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Survey   $survey
     * @param Question $question
     */
    public function show(Survey $survey, Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Question                 $question
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     */
    public function destroy(Question $question)
    {
        //
    }
}
