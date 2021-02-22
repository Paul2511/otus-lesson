<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictPersonalAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
    	if($request->get("access") == env("SECRET_PAGE_TOKEN")){
        	return $next($request);
    	} else {
    		abort(403);
    	}
    }
}
