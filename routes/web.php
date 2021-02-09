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
    return view('home');
})->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/profile', function () {
    return view('cabinet.home');
});

Route::get('/about', function () {
    return view('about');
});

app(\App\Services\Routes\Providers\Admin\AdminRoutesProvider::class)->register();
app(\App\Services\Routes\Providers\RoutesProvider::class)->register();