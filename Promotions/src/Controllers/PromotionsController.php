<?php

namespace Otuslessons\Promotions\Controllers;

use Otuslessons\Promotions\Controllers\Controller;
use Otuslessons\Promotions\Policies\PromotionGate;
use Otuslessons\Promotions\Services\Errors\ErrorsService;

class PromotionsController extends Controller{
    
    private ErrorsService $log;
    
    public function __construct(ErrorsService $errorService) {
        $this->log = $errorService;
    }
    public function index(){
        \Illuminate\Support\Facades\Gate::authorize(\App\Policies\Permission::GATE_PROMOTION);
        
        $this->log->writeLog('Promotions page');
        
        return view('promotions.cabinet.home');
    }
}
