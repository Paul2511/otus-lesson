<?php


namespace App\Services\Routes\CMS;


use App\Http\Controllers\CMS\Countries\CountryController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\Users\UsersController;
use Illuminate\Support\Facades\Route;

final class CMSRoutesProvider
{
    public function boot(): void
    {
        Route::group(['prefix' => CMSRoutes::CMS_BASE_PREFIX,'middleware'=>'auth'], function () {

            Route::get('/',[DashboardController::class,'index'])->name(CMSRoutes::CMS_DASHBOARD_INDEX);

            Route::resource('/users', UsersController::class)
                ->name('index',CMSRoutes::CMS_USERS_INDEX)
                ->name('create',CMSRoutes::CMS_USERS_CREATE)
                ->name('store',CMSRoutes::CMS_USERS_STORE)
                ->name('edit',CMSRoutes::CMS_USERS_EDIT)
                ->name('update',CMSRoutes::CMS_USERS_UPDATE)
                ->name('destroy',CMSRoutes::CMS_USERS_DELETE)
                ->name('show',CMSRoutes::CMS_USERS_SHOW);

            Route::resource('/countries',CountryController::class)
                ->name('index',CMSRoutes::CMS_COUNTRIES_INDEX)
                ->name('create',CMSRoutes::CMS_COUNTRIES_CREATE)
                ->name('store',CMSRoutes::CMS_COUNTRIES_STORE)
                ->name('edit',CMSRoutes::CMS_COUNTRIES_EDIT)
                ->name('update',CMSRoutes::CMS_COUNTRIES_UPDATE)
                ->name('destroy',CMSRoutes::CMS_COUNTRIES_DELETE)
                ->name('show',CMSRoutes::CMS_COUNTRIES_SHOW);

        });
    }
}
