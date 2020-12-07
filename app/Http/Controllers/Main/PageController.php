<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('main.page.about');
    }

    public function policy()
    {
        return view('main.page.policy');
    }
}
