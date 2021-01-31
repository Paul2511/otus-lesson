<?php


namespace App\Services\Routes\Providers\Admin;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\Countries\AdminCountriesController;
use Illuminate\Support\Facades\Route;

final class AdminRoutesProvider
{
    public function __construct()
    {

    }

    public function registerRoutes()
    {
        Route::group([
            'prefix' => '/admin',
            'as' => 'admin.',
        ], function () {
            Route::resources([
                '' => AdminBaseController::class,
                'countries' => AdminCountriesController::class
            ]);
        });
    }
}
