<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;

class AdminController extends AdminBaseController
{
    public function index(){
    	return view('admin.dashboard');
    }
}
