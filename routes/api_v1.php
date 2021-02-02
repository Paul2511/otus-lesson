<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\PetController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\FileController;
use App\Http\RouteNames;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('profile', [AuthController::class, 'profile'])->name(RouteNames::V1_PROFILE);
    Route::post('login', [AuthController::class, 'login'])->name(RouteNames::V1_LOGIN);
    Route::post('registration', [AuthController::class, 'registration'])->name(RouteNames::V1_CLIENT_REGISTRATION);
    Route::post('refresh', [AuthController::class, 'refresh'])->name(RouteNames::V1_TOKEN_REFRESH)->middleware(\App\Http\Middleware\JwtMiddleware::class);
});

Route::group([
    'prefix' => 'users',
], function () {
    Route::get('/{user}', [UserController::class, 'show'])->name(RouteNames::V1_GET_USER);
    Route::put('/{user}', [UserController::class, 'update'])->name(RouteNames::V1_UPDATE_USER);
    Route::get('/{user}/pets', [UserController::class, 'pets'])->name(RouteNames::V1_GET_USER_PETS);
});

Route::group([
    'prefix' => 'pets',
], function () {
    Route::get('/', [PetController::class, 'index'])->name(RouteNames::V1_GET_PETS);
    Route::post('/', [PetController::class, 'store'])->name(RouteNames::V1_CREATE_PET);
    Route::get('/list', [PetController::class, 'list'])->name(RouteNames::V1_GET_ALL_PETS);
    Route::get('/{pet}', [PetController::class, 'show'])->name(RouteNames::V1_GET_PET);
    Route::put('/{pet}', [PetController::class, 'update'])->name(RouteNames::V1_UPDATE_PET);
    Route::delete('/{pet}', [PetController::class, 'destroy'])->name(RouteNames::V1_DELETE_PET);
});

Route::group([
    'prefix' => 'files'
], function () {
    Route::post('upload-image', [FileController::class, 'uploadImage'])->name(RouteNames::V1_UPLOAD_IMAGE);
});


Route::any('{any}', function(){
    throw new BadRequestException(trans('exception.badRequest'), 400);
})->where('any', '.*');