<?php

namespace App\Http\Middleware;

use App\Services\Routes\Providers\User\UserRoutes;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Auth::check() )
        {
            // if user is not admin take him to his dashboard
            if ( Auth::user()->isUser() ) {
                return redirect(route(UserRoutes::USER_DASHBOARD, ['locale' => \App::getLocale()]));
            }

            // allow admin to proceed with request
            else if ( Auth::user()->isAdmin() || Auth::user()->isManager()) {
                return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}
