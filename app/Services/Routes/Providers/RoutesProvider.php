<?php

namespace App\Services\Routes\Providers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\PromotionsController;
use App\Services\Routes\Providers\Routes;

final class RoutesProvider {
	
	public function register(){
		Route::group([
			'middleware'=> ['auth', 'setlocale'],
                        'prefix' => '{locale}',
                        'where' => ['locale' => '[a-zA-Z]{2}']
		], function(){
                    Route::resource('promotions', PromotionsController::class);
                    Route::resource('categories', CategoriesController::class);
		});
	}
}