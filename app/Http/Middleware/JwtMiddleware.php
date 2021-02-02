<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
class JwtMiddleware extends BaseMiddleware
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
        try {
            $user = $this->auth->parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json([
                    'message' => trans('auth.wrongToken')
                ], 401);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                try
                {
                    $refreshed = $this->auth->refresh();
                    $user = $this->auth->setToken($refreshed)->toUser();
                    $request->headers->set('Authorization','Bearer '.$refreshed);
                } catch (JWTException $e){
                    return response()->json([
                        'message' => trans('auth.cannotRefresh')
                    ], 401);
                }
            } else {
                return response()->json([
                    'message' => trans('auth.wrongToken')
                ], 401);
            }
        }
        return $next($request);
    }
}
