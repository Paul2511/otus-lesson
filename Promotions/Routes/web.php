<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Otuslessons\Promotions\Controllers\Promotions;

Route::get('/promotions', [Promotions::class, 'index']);