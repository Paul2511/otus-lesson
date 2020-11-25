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
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});
Route::redirect('/', 'users/dashboard');
//Login
Route::view('register', 'auth.register')->name('register');
Route::view('login', 'auth.login')->name('login');

//Users Route Group
Route::prefix('users')->group(function () {
    Route::view('profile', 'users.profile')->name('profile');
    Route::view('contacts', 'users.contacts')->name('contacts');
    Route::view('knowledgebase', 'users.knowledgebase')->name('knowledgebase');
    Route::view('documents', 'users.documents')->name('documents');
    Route::view('payments', 'users.payments')->name('payments');
    Route::view('orders', 'users.orders')->name('orders');
    Route::view('dashboard', 'users.dashboard')->name('dashboard');
});

app(\App\Services\Routes\Providers\Admin\AdminRoutesProvider::class)->registerRoutes();