<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Middleware\AccessUser;
use App\Http\Middleware\AccessUserPet;

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
    Route::get('profile', [AuthController::class, 'profile']);
    Route::patch('profile/update', [AuthController::class, 'updateProfile']);
});

Route::group([
    'prefix' => 'users',
    'middleware'=>AccessUser::class
], function () {
    Route::get('/{id}', [UserController::class, 'show'])->name('showUser');
    Route::patch('/{id}', [UserController::class, 'update'])->name('updateUser');
});

Route::group([
    'prefix' => 'pets',
    'middleware'=>AccessUserPet::class
], function () {
    Route::get('/user/{userId}', [PetController::class, 'index'])->name('viewPets');
    Route::delete('/{id}', [PetController::class, 'destroy'])->name('deletePet');
});


