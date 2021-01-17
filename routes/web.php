<?php

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
