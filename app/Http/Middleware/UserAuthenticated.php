<?php

namespace App\Http\Middleware;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthenticated
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
            // if user admin take him to his dashboard
            if ( Auth::user()->isAdmin() || Auth::user()->isManager() ) {
                return redirect(route(AdminRoutes::ADMIN_DASHBOARD, ['locale' => \App::getLocale()]));
            }

            // allow user to proceed with request
            else if ( Auth::user()->isUser() ) {
                return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}
