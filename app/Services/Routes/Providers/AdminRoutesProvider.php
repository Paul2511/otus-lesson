<?php


namespace App\Services\Routes\Providers;


use App\Http\Controllers\Admin\Article\AdminArticleController;
use Illuminate\Support\Facades\Route;

final class AdminRoutesProvider
{
    public function register()
    {
        Route::group([
            'prefix' => '/admin',
            'as' => 'admin.',
            'middleware' => 'auth'
        ], function () {

            Route::resources([
                'articles' => AdminArticleController::class
            ]);

        });
    }
}
