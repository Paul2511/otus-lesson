<?php

use App\Http\Controllers\CMS\Permission\PermissionController;
use App\Http\Controllers\CMS\Role\RoleController;
use App\Http\Controllers\CMS\User\UserController;
use App\Http\Controllers\Desk\ColumnController;
use App\Http\Controllers\Desk\DeskController;
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

Route::get('/', [DeskController::class, 'index'])->name('home');
Route::resource('column', ColumnController::class);

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/price', function () {
    return view('pages.price');
})->name('price');

Route::get('/feedback', function () {
    return view('pages.feedback');
})->name('feedback');

Route::group(['prefix' => 'cms', 'middleware' => 'auth:web'], function () {
    Route::view('/', 'pages.cms.home.index')->name('cms.index');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
});

Auth::routes();

