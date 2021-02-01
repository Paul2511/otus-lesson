<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->roles()->first()->title == Role::ADMIN_ROLE) {
            return $next($request);
        } else {
            abort(401);
        }

    }
}
