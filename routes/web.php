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
    return view('front.index');
});
Route::get('/news', function () {
    return view('front.news');
});
Route::get('/adv', function () {
    return view('front.adv');
});
Route::get('/about', function () {
    return view('front.about');
});
Route::get('/login', function () {
    return view('front.login');
});
Route::get('/register', function () {
    return view('front.register');
});
