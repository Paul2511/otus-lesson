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
Route::redirect('/', '/dashboard');
Route::view('/users/profile', 'users.profile')->name('profile');
Route::view('/contacts', 'contacts')->name('contacts');
Route::view('/knowledgebase', 'knowledgebase')->name('knowledgebase');
Route::view('/documents', 'documents')->name('documents');
Route::view('/payments', 'payments')->name('payments');
Route::view('/orders', 'orders')->name('orders');
Route::view('register', 'auth.register')->name('register');
Route::view('login', 'auth.login')->name('login');
Route::view('/dashboard', 'dashboard')->name('dashboard');
