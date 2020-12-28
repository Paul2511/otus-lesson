<?php


namespace App\Services\Routes\Providers\Admin;

use App\Http\Controllers\Admin\Queues\AdminQueuesController;
use App\Http\Controllers\Admin\Resources\AdminResourcesController;
use App\Http\Controllers\Admin\Users\AdminUsersController;
use Illuminate\Support\Facades\Route;


final class AdminRoutesProvider
{
    public function __construct()
    {
    }

    public function register()
    {
        Route::group([
            'middleware' => 'auth'
        ], function () {
            Route::resource('users', AdminUsersController::class);
            Route::post('users/activate/{id}', [AdminUsersController::class, 'active'])->name( AdminRoutes::ADMIN_USERS_ACTIVATE);
            Route::post('resources', AdminResourcesController::class);
            Route::post('queues', AdminQueuesController::class);
        });

    }

}
