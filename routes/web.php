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
        return view('public.layouts.homepage');
    });

    Route::get('/login', function () {
        return view('public.layouts.auth');
    });

    Route::get('/logout', function () {
        return view('public.layouts.auth');
    });

    Route::post('/login', ['before' => 'csrf', function () {
        return view('public.layouts.auth');
    }]);

    Route::get( '/register', function () {
        return view('public.layouts.reg');
    });

    Route::post('/register', ['before' => 'csrf', function () {
        return view('public.layouts.reg');
    }]);

    Route::get( '/account', function () {
        return view('public.layouts.account');
    });

    Route::post('/account', ['before' => 'csrf', function () {
        return view('public.layouts.account');
    }]);

    Route::get('/contacts', function () {
        return view('public.layouts.contacts');
    });

    Route::get('/search', function () {
        return view('public.layouts.search');
    });

    Route::fallback(function () {
        App::abort(404);
    });

    //Auth::routes();
});


