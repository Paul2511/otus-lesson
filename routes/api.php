<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\RouteNames;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('registration', [AuthController::class, 'registration']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});


Route::group([
    'prefix' => 'users',
], function () {
    Route::get('/{user}', [UserController::class, 'show'])->name(RouteNames::GET_USER);
    Route::patch('/{user}', [UserController::class, 'update'])->name(RouteNames::UPDATE_USER);
});

Route::group([
    'prefix' => 'pets',
], function () {
    Route::get('/user/{user}', [PetController::class, 'index'])->name(RouteNames::GET_USER_PETS);
    Route::delete('/{pet}', [PetController::class, 'destroy'])->name(RouteNames::DELETE_PET);
});


//Вместо fallback
Route::any('{any}', function(){
    return response()->json([
        'success'    => false,
        'message'   => trans('main.urlNotFound'),
    ], 404);
})->where('any', '.*');


