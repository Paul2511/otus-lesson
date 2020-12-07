<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        return view('main.user.login');
    }

    public function signup()
    {
        return view('main.user.signup');
    }

    public function profile()
    {
        return view('main.user.profile');
    }
}
