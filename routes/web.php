<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, TaskController, TodoController, CommentController, KnowledgeController, ClientController};
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
    return view('main');
});
Route::get('/contacts', function () {
    return view('contacts');
});
Route::resource("/user", UserController::class);
Route::get('/login', [UserController::class, "login"])->name('user.login');
Route::post('/login', [UserController::class, "authenticate"])->name('user.auth');
Route::get("/logout", [UserController::class, "logout"])->name('user.logout');
Route::resource("/task", TaskController::class);
Route::post("/todo", [TodoController::class, "store"])->name('todo.store');
Route::put("/todo", [TodoController::class, "update"])->name('todo.update');
Route::delete("/todo/{todo}",[TodoController::class, "delete"])->name("todo.delete");
Route::post("/comment", [CommentController::class, "store"])->name('comment.store');
Route::put("/comment", [CommentController::class, "update"])->name('comment.update');
Route::resource('/knowledge', KnowledgeController::class);
Route::resource('/client', ClientController::class);