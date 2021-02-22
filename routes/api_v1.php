<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\PetController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\FileController;
use App\Http\Controllers\Api\v1\PetTypeController;
use App\Http\Controllers\Api\v1\SpecializationController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\RouteNames;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('profile', [AuthController::class, 'profile'])->name(RouteNames::V1_PROFILE);
    Route::post('login', [AuthController::class, 'login'])->name(RouteNames::V1_LOGIN);
    Route::post('login-as', [AuthController::class, 'loginAs'])->name(RouteNames::V1_LOGIN_AS);
    Route::post('client-register', [AuthController::class, 'clientRegister'])->name(RouteNames::V1_CLIENT_REGISTRATION);
    Route::post('spec-register', [AuthController::class, 'specRegister'])->name(RouteNames::V1_SPEC_REGISTRATION);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name(RouteNames::V1_FORGOT_PASSWORD);
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name(RouteNames::V1_RESET_PASSWORD);
    Route::post('change-password', [AuthController::class, 'changePassword'])->name(RouteNames::V1_CHANGE_PASSWORD);
    Route::post('refresh', [AuthController::class, 'refresh'])->name(RouteNames::V1_TOKEN_REFRESH)->middleware(\App\Http\Middleware\JwtMiddleware::class);
});

Route::group([
    'prefix' => 'users',
], function () {
    Route::post('/', [UserController::class, 'store'])->name(RouteNames::V1_CREATE_USER);
    Route::get('/list', [UserController::class, 'list'])->name(RouteNames::V1_GET_ALL_USERS);
    Route::get('/{user}', [UserController::class, 'show'])->name(RouteNames::V1_GET_USER);
    Route::put('/{user}', [UserController::class, 'update'])->name(RouteNames::V1_UPDATE_USER);
    Route::get('/{user}/pets', [UserController::class, 'pets'])->name(RouteNames::V1_GET_USER_PETS);
    Route::get('/{user}/comments', [UserController::class, 'comments'])->name(RouteNames::V1_GET_USER_COMMENTS);
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
    'prefix' => 'pet-types',
], function () {
    Route::get('/', [PetTypeController::class, 'index'])->name(RouteNames::V1_GET_PET_TYPES);
    Route::post('/', [PetTypeController::class, 'store'])->name(RouteNames::V1_CREATE_PET_TYPE);
    Route::put('/{petType}', [PetTypeController::class, 'update'])->name(RouteNames::V1_UPDATE_PET_TYPE);
    Route::delete('/{petType}', [PetTypeController::class, 'destroy'])->name(RouteNames::V1_DELETE_PET_TYPE);
});

Route::group([
    'prefix' => 'specializations',
], function () {
    Route::get('/', [SpecializationController::class, 'index'])->name(RouteNames::V1_GET_SPECIALIZATIONS);
    Route::post('/', [SpecializationController::class, 'store'])->name(RouteNames::V1_CREATE_SPECIALIZATION);
    Route::put('/{specialization}', [SpecializationController::class, 'update'])->name(RouteNames::V1_UPDATE_SPECIALIZATION);
    Route::delete('/{specialization}', [SpecializationController::class, 'destroy'])->name(RouteNames::V1_DELETE_SPECIALIZATION);
});

Route::group([
    'prefix' => 'comments',
], function () {
    Route::post('/', [CommentController::class, 'store'])->name(RouteNames::V1_CREATE_COMMENT);
    Route::put('/{comment}', [CommentController::class, 'update'])->name(RouteNames::V1_UPDATE_COMMENT);
    Route::delete('/{comment}', [CommentController::class, 'destroy'])->name(RouteNames::V1_DELETE_COMMENT);
});

Route::group([
    'prefix' => 'files'
], function () {
    Route::post('upload-image', [FileController::class, 'uploadImage'])->name(RouteNames::V1_UPLOAD_IMAGE);
});


Route::any('{any}', function(){
    throw new BadRequestException(trans('exception.badRequest'), 400);
})->where('any', '.*');