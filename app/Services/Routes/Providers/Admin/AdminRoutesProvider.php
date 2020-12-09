<?php

namespace App\Services\Routes\Providers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Categories\AdminCategoriesController;
use App\Http\Controllers\Admin\Users\AdminUsersController;

final class AdminRoutesProvider {
	
	public function register(){
		Route::group([
			'prefix'=>'/admin',
		], function(){
			Route::get('/', [
                                AdminController::class,
                                'index']
                                )->name(AdminRoutes::ADMIN_INDEX);
                        Route::group([
                            'as'=> 'admin.'
                        ],function(){
                            Route::resource('users', AdminUsersController::class);
                        });
                        Route::group([
                            'as'=> 'admin.',
                        ],function(){
                            Route::resource('categories', AdminCategoriesController::class);
                        });
		});
	}
}