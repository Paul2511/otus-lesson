<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBaseController extends Controller
{

    const LIST_PER_PAGE = 30;

    public function index(Request $request)
    {
        return view('back.index');
    }
}
