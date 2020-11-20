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

/*Route::get('/', function () {
    dd(\App\Models\Region::whereNotNull('parent_id')->pluck('id')->toArray());
});*/
Route::view('/', 'pages.main.index')->name('page.main');
Route::view('/about', 'pages.about.index')->name('page.about');
Route::view('/profile', 'pages.profile.index')->name('page.profile');
Route::view('/register', 'auth.register.index')->name('register');
