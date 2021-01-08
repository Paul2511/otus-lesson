<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPagesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.welcome');
    }

    public function contacts()
    {
        return view('pages.contacts');
    }


}
