<?php

namespace App\Services\Routes\Providers\Helpers;

use App\Http\Controllers\Helpers\LocaleController;
use Illuminate\Support\Facades\Route;

class HelpersRoutesProvider
{

    public function register()
    {
        Route::group([
            'middleware' => ['log']
        ], function () {
            Route::get('locale/get', [LocaleController::class, 'getLocale'])->name( HelpersRoutes::GET_LOCALE);
            Route::post('locale/set', [LocaleController::class, 'setLocale'])->name( HelpersRoutes::SET_LOCALE);
        });
    }

}
