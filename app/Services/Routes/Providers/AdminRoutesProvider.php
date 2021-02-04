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
            'namespace' => 'App\Http\Controllers\Admin\Article',
        ], function () {

            Route::get('/articles',
                [AdminArticleController::class, 'index'])
                ->name(AdminRoutes::ADMIN_ARTICLE_INDEX);

            Route::get('/articles/add',
                [AdminArticleController::class, 'create'])
                ->name(AdminRoutes::ADMIN_ARTICLE_CREATE);

            Route::match(['put', 'path'], '/articles/{article}',
                [AdminArticleController::class, 'update'])
                ->name(AdminRoutes::ADMIN_ARTICLE_UPDATE);

            Route::get('/articles/{article}',
                [AdminArticleController::class, 'show'])
                ->name(AdminRoutes::ADMIN_ARTICLE_SHOW);

            Route::get('/articles/{article}/edit',
                [AdminArticleController::class, 'edit'])
                ->name(AdminRoutes::ADMIN_ARTICLE_EDIT);

            Route::post('/articles/',
                [AdminArticleController::class, 'store'])
                ->name(AdminRoutes::ADMIN_ARTICLE_STORE);

            Route::delete('/articles/{article}',
                [AdminArticleController::class, 'destroy'])
                ->name(AdminRoutes::ADMIN_ARTICLE_DELETE);
        });
    }
}
