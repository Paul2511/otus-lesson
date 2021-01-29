<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FileController;
use App\Http\RouteNames;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
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
    Route::get('profile', [AuthController::class, 'profile'])->name(RouteNames::PROFILE);
    Route::post('login', [AuthController::class, 'login'])->name(RouteNames::LOGIN);
    Route::post('registration', [AuthController::class, 'registration'])->name(RouteNames::CLIENT_REGISTRATION);
    Route::post('refresh', [AuthController::class, 'refresh'])->name(RouteNames::TOKEN_REFRESH);
});


Route::group([
    'prefix' => 'users',
], function () {
    Route::get('/{user}', [UserController::class, 'show'])->name(RouteNames::GET_USER);
    Route::put('/{user}', [UserController::class, 'update'])->name(RouteNames::UPDATE_USER);
    Route::get('/{user}/pets', [UserController::class, 'pets'])->name(RouteNames::GET_USER_PETS);
});

Route::group([
    'prefix' => 'pets',
], function () {
    Route::get('/', [PetController::class, 'index'])->name(RouteNames::GET_PETS);
    Route::get('/list', [PetController::class, 'list'])->name(RouteNames::GET_ALL_PETS);
    Route::get('/{pet}', [PetController::class, 'show'])->name(RouteNames::GET_PET);
    Route::put('/{pet}', [PetController::class, 'update'])->name(RouteNames::UPDATE_PET);
    Route::delete('/{pet}', [PetController::class, 'destroy'])->name(RouteNames::DELETE_PET);
    Route::post('/', [PetController::class, 'store'])->name(RouteNames::CREATE_PET);
});


Route::group([
    'prefix' => 'files'
], function () {
    Route::post('upload-image', [FileController::class, 'uploadImage'])->name(RouteNames::UPLOAD_IMAGE);
});

//Вместо fallback
Route::any('{any}', function(){
    throw new BadRequestException(trans('exception.badRequest'), 400);
})->where('any', '.*');


