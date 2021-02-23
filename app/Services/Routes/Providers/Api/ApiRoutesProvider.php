<?php

namespace App\Services\Routes\Providers\Api;

use App\Http\Controllers\Api\Surveys\ApiSurveysController;
use App\Services\Surveys\SurveysService;
use Route;

class ApiRoutesProvider
{
    public function register()
    {
        $this->registerSurveyRoutes();
    }

    private function registerSurveyRoutes()
    {
        Route::as('api.')->middleware('auth:api')->group(
            function () {
                Route::as('surveys.list')->get('surveys/list', [ApiSurveysController::class, 'list']);

                Route::apiResource(
                    'surveys',
                    ApiSurveysController::class
                );
            }
        );
    }
}
