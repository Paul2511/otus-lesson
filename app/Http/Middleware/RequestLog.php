<?php


namespace App\Http\Middleware;


use App\Services\Helpers\RequestLogger;
use Closure;
use Illuminate\Http\Request;

class RequestLog
{
    public function handle(Request $request, Closure $next)
    {
        RequestLogger::addlog();

        return $next($request);
    }
}