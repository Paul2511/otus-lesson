<?php

use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\WordController;
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
})
    ->name('main');

Route::resource('/dictionaries', DictionaryController::class)
    ->name('index', 'dictionaries.index')
    ->name('show', 'dictionaries.show')
    ->name('store', 'dictionaries.store')
    ->name('destroy', 'dictionaries.destroy');
Route::resource('/words', WordController::class)
    ->name('index', 'words.index')
    ->name('show', 'words.show')
    ->name('store', 'words.store')
    ->name('destroy', 'words.destroy');

Route::get('/training', function () {
    return view('training');
});


