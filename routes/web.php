<?php

use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\WordController;
use App\Services\Dictionaries\Providers\Routes as DictionariesRoutes;
use App\Services\Words\Providers\Routes as WordsRoutes;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('/{locale}')
    ->middleware('locale')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\MainController::class, 'index'])
            ->name('main');

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
            ->name('home');

        Route::resource('/dictionaries', DictionaryController::class)
            ->name('index', DictionariesRoutes::DICTIONARIES_INDEX)
            ->name('show', DictionariesRoutes::DICTIONARIES_SHOW)
            ->name('store', DictionariesRoutes::DICTIONARIES_STORE)
            ->name('destroy', DictionariesRoutes::DICTIONARIES_DESTROY);

        Route::resource('/words', WordController::class)
            ->name('index', WordsRoutes::WORDS_INDEX)
            ->name('show', WordsRoutes::WORDS_SHOW)
            ->name('store', WordsRoutes::WORDS_STORE)
            ->name('destroy', WordsRoutes::WORDS_DESTROY);

        Route::get('/training', function () {
            return view('training');
        });
    });
