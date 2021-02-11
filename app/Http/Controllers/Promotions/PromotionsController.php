<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Policies\PromotionGate;
use App\Services\Errors\ErrorsService;

class PromotionsController extends Controller{
    
    private ErrorsService $log;
    
    public function __construct(ErrorsService $errorService) {
        $this->log = $errorService;
    }
    public function index(){
        \Illuminate\Support\Facades\Gate::authorize(\App\Policies\Permission::GATE_PROMOTION);
        
        $this->log->writeLog('Promotions page');
        
        return view('cabinet.home');
    }
}
