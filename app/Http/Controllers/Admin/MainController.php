<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        $students = User::where('type', User::TYPE_STUDENT)->count();
        $teachers = User::where('type', User::TYPE_TEACHER)->count();
        $groups = Group::count();

        return view('admin.index', compact('students','teachers', 'groups'));
    }
}
