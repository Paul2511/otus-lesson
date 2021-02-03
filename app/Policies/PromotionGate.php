<?php

namespace App\Policies;

use App\Services\Auth\AuthService;

class PromotionGate {
    
    private AuthService $authService;
    
    public function __construct(
            AuthService $authService
    ) {
        $this->authService = $authService;
    }
    
    public function view(User $user){
        $this->authService->hasUserPermission($user, Permission::GATE_PROMOTION, Permission::VIEW);
    }
}
