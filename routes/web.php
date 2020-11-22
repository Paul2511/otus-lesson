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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/contacts', function () {
    return view('pages.contacts');
})
    ->name('contacts');

/* TODO: Заменить страницами, созданными через скаффолдинг  */
Route::get('/dev/login', function () {
    return view('pages.login');
})
    ->name('login');

Route::get('/dev/register', function () {
    return view('pages.register');
})
    ->name('register');


Route::prefix('admin')->group(
    function () {
        Route::get(
            'surveys',
            function () {
                return view('admin.survey.list');
            }
        );
    }
);