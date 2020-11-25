<?php


namespace App\Services\Routes\Providers\Admin;


use App\Http\Controllers\Admin\AdminDashboardIndexController;
use App\Http\Controllers\Admin\Users\AdminUsersController;
use Illuminate\Support\Facades\Route;

final class AdminRoutesProvider
{
    public function registerRoutes()
    {
        Route::get('admin/dashboard', AdminDashboardIndexController::class)->name(AdminRoutes::ADMIN_DASHBOARD);
        //Admin Routes
        Route::group([
            'prefix' => 'admin',
            'as' => 'admin.',
        ], function () {
            Route::resources([
                'users' => AdminUsersController::class,
            ]);
        });
    }
}