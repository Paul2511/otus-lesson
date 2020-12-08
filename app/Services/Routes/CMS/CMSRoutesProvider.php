<?php


namespace App\Services\Routes\CMS;


use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\Users\UsersController;
use Illuminate\Support\Facades\Route;

final class CMSRoutesProvider
{
    public function boot(): void
    {
        Route::group(['prefix' => CMSRoutes::CMS_BASE_PREFIX], function () {

            Route::get('/',[DashboardController::class,'index'])->name(CMSRoutes::CMS_DASHBOARD_INDEX);

            Route::group(['prefix' => 'users'],function(){
                Route::get('/',[UsersController::class,'index'])->name(CMSRoutes::CMS_USERS_INDEX);
                Route::get('/create',[UsersController::class,'create'])->name(CMSRoutes::CMS_USERS_CREATE);
                Route::post('/store',[UsersController::class,'store'])->name(CMSRoutes::CMS_USERS_STORE);
                Route::get('/{user}/edit',[UsersController::class,'edit'])->name(CMSRoutes::CMS_USERS_EDIT);
                Route::patch('/{user}',[UsersController::class,'update'])->name(CMSRoutes::CMS_USERS_UPDATE);
                Route::delete('/{user}',[UsersController::class,'destroy'])->name(CMSRoutes::CMS_USERS_DELETE);
                Route::get('/{user}',[UsersController::class,'show'])->name(CMSRoutes::CMS_USERS_SHOW);
            });

        });
    }
}
