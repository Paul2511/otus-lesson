<?php


namespace App\Http\Controllers\Auth;

use App\Services\Routes\Providers\PublicRoutes\PublicRoutes;


/**
 * Where to redirect users after login.
 */
trait RedirectsTo
{

    protected function redirectTo(): string
    {
        return PublicRoutes::home();
    }

}
