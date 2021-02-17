<?php


namespace App\Services\Routes\Providers;


use App\Http\Controllers\Admin\Article\AdminArticleController;
use App\Http\Middleware\Localise;
use Illuminate\Support\Facades\Route;

final class AdminRoutesProvider
{
    public function register()
    {
        Route::group([
            'prefix' => '{locale}/admin',
            'as' => 'admin.',
            'middleware' => [
                Localise::class,
                'auth'
            ]
        ], function () {

            Route::resources([
                'articles' => AdminArticleController::class
            ]);

        });
    }
}
