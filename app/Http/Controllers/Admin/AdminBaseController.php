<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminBaseController extends Controller
{
    public function getCurrentUser(): ?User
    {
        return Auth::user();
    }

}
