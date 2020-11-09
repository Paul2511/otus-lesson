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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::get('/', function () {
    return view('main');
});

Route::get('/dictionaries', function () {
    return view('dictionaries');
});

Route::get('/dictionary', function () {
    return view('dictionary');
});

Route::get('/training', function () {
    return view('training');
});


