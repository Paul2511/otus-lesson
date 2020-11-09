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
    return redirect('/'.app()->getLocale());
});

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'setlocale'
], function() {

    Route::get('/', function () {
        return view('public.pages.homepage.index');
    });

    Route::get('/login', function () {
        return view('public.pages.auth.index');
    });

    Route::get('/logout', function () {
        return view('public.pages.auth.index');
    });

    Route::post('/login', ['before' => 'csrf', function () {
        return view('public.pages.auth.index');
    }]);

    Route::get( '/register', function () {
        return view('public.pages.register.index');
    });

    Route::post('/register', ['before' => 'csrf', function () {
        return view('public.pages.register.index');
    }]);

    Route::get( '/account', function () {
        return view('public.pages.accounts.index');
    });

    Route::post('/account', ['before' => 'csrf', function () {
        return view('public.pages.accounts.index');
    }]);

    Route::get('/contacts', function () {
        return view('public.pages.contacts.index');
    });

    Route::get('/search', function () {
        return view('public.pages.search.index');
    });

    Route::fallback(function () {
        App::abort(404);
    });

    //Auth::routes();
});


