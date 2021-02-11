<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyAccess
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
    	if($request->access == 1){
        	return $next($request);
    	} else {
    		abort(403);
    	}
    }
}
