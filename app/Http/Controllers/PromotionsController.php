<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Policies\PromotionGate;
class PromotionsController extends Controller{
    public function index(){
        \Illuminate\Support\Facades\Gate::authorize(\App\Policies\Permission::GATE_PROMOTION);
        
        return view('cabinet.home');
    }
}
