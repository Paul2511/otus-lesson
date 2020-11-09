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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login', function() {
    $data = [
        'category_name' => 'auth',
        'page_name' => 'auth_default',
        'has_scrollspy' => 0,
        'scrollspy_offset' => '',
    ];
    return view('pages.authentication.auth_login')->with($data);
});

    Route::get('/home', function() {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'home',
            'has_scrollspy' => 1,
            'scrollspy_offset' => 140,

        ];
        return view('dashboard')->with($data);
    });


// ABOUT
Route::get('/about', function() {
    $data = [
        'category_name' => 'about',
        'page_name' => 'about_us',
        'has_scrollspy' => 1,
        'scrollspy_offset' => 140,

    ];
    return view('about')->with($data);
});

// RECORDS
Route::prefix('records')->group(function () {
    Route::get('/simple', function() {
        $data = [
            'category_name' => 'records',
            'page_name' => 'simple',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.records.simple')->with($data);
    });
    Route::get('/advanced', function() {
        $data = [
            'category_name' => 'records',
            'page_name' => 'advanced',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.records.advanced')->with($data);
    });
});

// REPORTS
Route::prefix('reports')->group(function () {
    Route::get('/balance', function() {
        $data = [
            'category_name' => 'reports',
            'page_name' => 'balance',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.reports.balance')->with($data);
    });
    Route::get('/processed-calls', function() {
        $data = [
            'category_name' => 'reports',
            'page_name' => 'processed-calls',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.reports.processed-calls')->with($data);
    });
    Route::get('/quotas', function() {
        $data = [
            'category_name' => 'reports',
            'page_name' => 'quotas',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.reports.quotas')->with($data);
    });
    Route::get('/service', function() {
        $data = [
            'category_name' => 'reports',
            'page_name' => 'service',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.reports.service')->with($data);
    });
    Route::get('/stat', function() {
        $data = [
            'category_name' => 'reports',
            'page_name' => 'stat',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.reports.stat')->with($data);
    });
});

// STATISTIC
Route::prefix('statistic')->group(function () {
    Route::get('/efficiency', function() {
        $data = [
            'category_name' => 'statistic',
            'page_name' => 'efficiency',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.statistic.efficiency')->with($data);
    });
    Route::get('/online', function() {
        $data = [
            'category_name' => 'statistic',
            'page_name' => 'online',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.statistic.online')->with($data);
    });
});

    // Users
    Route::prefix('users')->group(function () {
        Route::get('/profile', function() {
            $data = [
                'category_name' => 'users',
                'page_name' => 'profile',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',

            ];
            return view('pages.users.user_profile')->with($data);
        });
    });


