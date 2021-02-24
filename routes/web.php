<?php

use App\Services\Routes\Providers\Admin\AdminRoutesProvider;
use App\Services\Routes\Providers\DebugRoutes\DebugRoutesProvider;
use App\Services\Routes\Providers\PublicRoutes\PublicRoutesProvider;


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

app(AdminRoutesProvider::class)->register();
app(PublicRoutesProvider::class)->register();
app(DebugRoutesProvider::class)->register();
