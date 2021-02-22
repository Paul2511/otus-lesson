<?php

use App\Http\RouteNames;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Middleware\WebApplicationData;
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

Route::get('/reset-password/{token}', function ($token) {
    return view('application', ['token' => $token]);
})->name(RouteNames::PASSWORD_RESET);

Route::get('/{any}', ApplicationController::class)
    ->where('any', '.*')
    ->middleware(WebApplicationData::class);



