<?php

use App\Http\Controllers\Sources\DashboardController;
use App\Services\Routes\Providers\Admin\AdminRoutesProvider;
use App\Services\Routes\Providers\Sources\SourcesRoutesProvider;
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

app(AdminRoutesProvider::class)->register();
app(SourcesRoutesProvider::class)->register();



