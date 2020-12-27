<?php


namespace App\Http\Controllers\CMS;


use App\Http\Controllers\CMS\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('cms.dashboard');
    }
}
