<?php

namespace App\Http\Middleware;

use App\Services\Auth\Auth\AuthService;
use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    private AuthService $authService;


    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function handle(Request $request, Closure $next)
    {

        if ($this->authService->isAdminUser(auth()->user())) {
            return $next($request);
        } else {
            abort(403);
        }

    }
}
