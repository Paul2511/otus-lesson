<?php


namespace App\Services\Routes\Providers\Admin;


use App\Http\Controllers\Admin\Surveys\AdminAnswersController;
use App\Http\Controllers\Admin\Surveys\AdminQuestionsController;
use App\Http\Controllers\Admin\Surveys\AdminSurveysController;
use Route;


class AdminRoutesProvider
{

    public function register()
    {

        Route::prefix('admin')
            ->as('admin.')
            // ->middleware('auth.basic')
            ->group(
                function () {
                    $this->registerSurveyRoutes();
                }
            );

    }

    private function registerSurveyRoutes()
    {
        Route::resource('surveys', AdminSurveysController::class);
        Route::resource('surveys/{survey}/questions', AdminQuestionsController::class);
        Route::resource('surveys/{survey}/questions/{question}/answers', AdminAnswersController::class);
    }

}