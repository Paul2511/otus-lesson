<?php


namespace App\Http\Controllers\Auth;

/**
 * Where to redirect users after login.
 */
trait RedirectsTo
{

    protected function redirectTo(): string
    {
        return route('home');
    }

}