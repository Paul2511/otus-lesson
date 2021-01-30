<?php

use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', [\App\Http\Controllers\Main\PageController::class, 'about'])->name('site.about');
Route::get('policy', [\App\Http\Controllers\Main\PageController::class, 'policy'])->name('site.policy');

Route::get('login', [\App\Http\Controllers\Main\UserController::class, 'login'])->name('user.login');
Route::get('signup', [\App\Http\Controllers\Main\UserController::class, 'signup'])->name('user.signup');
Route::get('profile', [\App\Http\Controllers\Main\UserController::class, 'profile'])->name('user.profile');

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');

    Route::resource('/skills', '\App\Http\Controllers\Admin\Dictionary\SkillsController');
    Route::resource('/levels', '\App\Http\Controllers\Admin\Dictionary\LevelsController');
    Route::resource('/group-sizes', '\App\Http\Controllers\Admin\Dictionary\GroupSizesController');

    Route::resource('/users', '\App\Http\Controllers\Admin\User\MainController');
    Route::namespace('User')->name('users.')->group(function () {
        Route::resource('/users/{user}/skills', '\App\Http\Controllers\Admin\User\SkillsController');
    });

    Route::resource('/groups', '\App\Http\Controllers\Admin\Group\MainController');
    Route::namespace('Group')->name('groups.')->group(function () {
        Route::resource('/groups/{group}/students', '\App\Http\Controllers\Admin\Group\StudentsController');
        Route::resource('/groups/{group}/teachers', '\App\Http\Controllers\Admin\Group\TeachersController');
    });
});
