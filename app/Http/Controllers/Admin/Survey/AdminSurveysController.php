<?php

namespace App\Http\Controllers\Admin\Survey;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Services\Routes\Provider\AdminSurveysRoutes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;


class AdminSurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $surveys = Survey::paginate(8);

        return view('admin.surveys.index', compact('surveys'));
    }

    /**
     * Display the specified resource.
     *
     * @param Survey $survey
     */
    public function show(Survey $survey)
    {
        return view('admin.surveys.show', compact('survey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Survey $survey
     *
     * @return View
     */
    public function edit(Survey $survey): View
    {
        $formOpenOptions = [
            'url'    => route(AdminSurveysRoutes::SURVEYS_UPDATE, $survey),
            'method' => 'PUT',
        ];

        return view('admin.surveys.edit', compact('survey', 'formOpenOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formOpenOptions = [
            'url'    => route(AdminSurveysRoutes::SURVEYS_STORE),
            'method' => 'POST',
        ];

        $survey = new Survey;

        return view('admin.surveys.edit', compact('survey', 'formOpenOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $survey = new Survey($request->all());
        $survey->save();

        return redirect(route(AdminSurveysRoutes::SURVEYS_SHOW, $survey));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Survey                   $survey
     */
    public function update(Request $request, Survey $survey)
    {
        $survey->update($request->all());

        return redirect(route(AdminSurveysRoutes::SURVEYS_EDIT, $survey));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Survey $survey
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();

        return redirect(route(AdminSurveysRoutes::SURVEYS_INDEX));
    }
}
