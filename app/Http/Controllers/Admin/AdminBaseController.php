<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Helpers\RequestLogger;

class AdminBaseController extends Controller
{
    const DEFAULT_MODELS_PER_PAGE = 10;

}