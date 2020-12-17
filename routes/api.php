<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\Auth\AuthController;

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
    Route::get('/{user}', [UserController::class, 'show']);
    Route::patch('/{user}', [UserController::class, 'update']);
});

Route::group([
    'prefix' => 'pets',
], function () {
    Route::get('/user/{user}', [PetController::class, 'index']);
    Route::delete('/{pet}', [PetController::class, 'destroy']);
});



