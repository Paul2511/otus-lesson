<?php


namespace App\Services\Routes\Providers\Admin;


use App\Http\Controllers\Admin\AdminDashboardIndexController;
use App\Http\Controllers\Admin\Users\AdminUsersController;
use Illuminate\Support\Facades\Route;

final class AdminRoutesProvider
{
    public function registerRoutes()
    {
        Route::redirect('admin', 'admin/dashboard');
        Route::view('admin/profile', AdminRoutes::ADMIN_PROFILE)->name('profile');
        Route::get('admin/dashboard', AdminDashboardIndexController::class)
            ->name(AdminRoutes::ADMIN_DASHBOARD)
            ->middleware('auth','admin');
        //Admin Routes
        Route::group([
            'prefix' => 'admin',
            'as' => 'admin.',
            'middleware' => ['auth', 'admin' , 'log'],
        ], function () {
            Route::resources([
                'users' => AdminUsersController::class,
            ]);
        });
    }
}