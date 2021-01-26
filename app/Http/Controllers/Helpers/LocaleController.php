<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function getLocale(Request $request)
    {
        return $request->cookie('locale');
    }

    public function setLocale(Request $request){
        return response()->json(['status'=>'ok'])->withCookie(cookie('locale', $request->get('locale'), 45000));
    }
}
