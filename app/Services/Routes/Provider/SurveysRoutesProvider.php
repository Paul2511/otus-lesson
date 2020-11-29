<?php


namespace App\Services\Routes\Provider;


use App\Http\Controllers\Admin\Survey\AdminSurveyQuestionsController;
use App\Http\Controllers\Admin\Survey\AdminSurveysController;
use Route;


class SurveysRoutesProvider
{

    public function register()
    {

        Route::prefix('admin')->as('admin.')->group(function () {
            $this->registerAdminRoutes();
        });

    }

    private function registerAdminRoutes()
    {

        Route::resource('surveys', AdminSurveysController::class);
        Route::resource('survey/{survey}/questions', AdminSurveyQuestionsController::class);

    }

}