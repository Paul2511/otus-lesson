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
Route::redirect('/', '/dashboard');
Route::view('/users/profile', 'users.profile')->name(__('users/profile.profile'));
Route::view('/contacts', 'contacts')->name(__('_partials/_sidebar.contacts'));
Route::view('/knowledgebase', 'knowledgebase')->name(__('_partials/_sidebar.knowledgebase'));
Route::view('/documents', 'documents')->name(__('_partials/_sidebar.documents'));
Route::view('/payments', 'payments')->name(__('_partials/_sidebar.payments'));
Route::view('/orders', 'orders')->name(__('_partials/_sidebar.orders'));
Route::view('register', 'auth.register')->name(__('auth.register'));
Route::view('login', 'auth.login')->name(__('auth.login'));
Route::view('/dashboard', 'dashboard')->name(__('pages/dashboard.dashboard'));
