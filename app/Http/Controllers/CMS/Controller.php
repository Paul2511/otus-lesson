<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    public function getCurrentUser(): ?User
    {
        return Auth::user();
    }
}
