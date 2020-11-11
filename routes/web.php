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
    return view('home.index');
});

Route::get('/profile', function () {
    return view('lk.profile');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/about', function () {
    return view('pages.about');
});
