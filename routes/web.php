<?php

use App\Http\Controllers\HomeController;
use App\Services\Routes\Providers\AdminRoutesProvider;
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

Route::get('/profile', function () {
    return view('profile.index');
});

Route::get('/about', function () {
    return view('about.index');
});

app(AdminRoutesProvider::class)->register();

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
