<?php


namespace App\Services\Helpers;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class RequestParser
{
    static $except = [
        'password',
        'confirmation'
    ];

    public static function parse(): array
    {
        $route = Route::current();
        $controller = $route->getActionName();
        $params = Request::except(self::$except);
        $userName = (Request::user()) ? Request::user()->first_name : null;
        $userRole = (Request::user()) ? Request::user()->role : null;
        $userAgent = Request::userAgent();
        $ip = Request::ip();

        $context = [
            'Controller' => $controller,
            'Params' => json_encode($params, JSON_UNESCAPED_UNICODE),
            'User' => $userName,
            'Role' => $userRole,
            'User Agent' => $userAgent,
            'IP' => $ip,
            'Method' => Request::getMethod(),
        ];

        return $context;
    }

}