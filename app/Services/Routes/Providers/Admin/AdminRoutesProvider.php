<?php


namespace App\Services\Routes\Providers\Admin;


use App\Http\Controllers\Admin\AdminDashboardIndexController;
use App\Http\Controllers\Admin\Users\AdminUsersController;
use Illuminate\Support\Facades\Route;

final class AdminRoutesProvider
{
    public function registerRoutes()
    {
        //Admin Routes
        Route::group([
            'prefix' => '{locale}/admin',
            'where' => ['locale' => '[a-zA-Z]{2}'],
            'as' => 'admin.',
            'middleware' => ['auth', 'admin' , 'log'],
        ], function () {
            Route::resources([
                'users' => AdminUsersController::class,
            ]);
            Route::redirect('/', 'dashboard');
            Route::view('profile', AdminRoutes::ADMIN_PROFILE)->name('profile');

        });
        Route::get('{locale}/admin/dashboard', AdminDashboardIndexController::class)
            ->name(AdminRoutes::ADMIN_DASHBOARD)
            ->middleware('auth','admin', 'log');
    }
}