<?php

use App\Http\Controllers\HomeController;
use App\Services\Routes\Providers\Admin\AdminRoutesProvider;
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
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contacts', function () {
    return view('pages.contacts');
})
    ->name('contacts');


Route::prefix('debug')
    ->as('debug.')
    ->middleware('auth')
    ->group(
        function () {
            Route::get('error', function () {
                return 1 / 0;
            })->name('error');

            Route::get('admin', function () {
                Auth::user()->role = \App\Models\User::ROLE_ADMIN;
                Auth::user()->save();

                dump(Auth::user());
                // return redirect()->back();
            });

            Route::get('default', function () {
                Auth::user()->role = \App\Models\User::ROLE_DEFAULT;
                Auth::user()->save();

                dump(Auth::user());
                // return redirect()->back();
            });

            Route::get('moderator', function () {
                Auth::user()->role = \App\Models\User::ROLE_MODERATOR;
                Auth::user()->save();

                dump(Auth::user());
                // return redirect()->back();
            });
        }
    );


app(AdminRoutesProvider::class)->register();
