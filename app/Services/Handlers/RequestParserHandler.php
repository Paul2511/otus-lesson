<?php


namespace App\Services\Handlers;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class RequestParserHandler
{
    static $except = [
        'password',
        'confirmation'
    ];

    public static function handle(): array
    {
        $route = Route::current();
        $controller = $route->getActionName();
        $params = Request::except(self::$except);
        $userName = (Request::user()) ? Request::user()->full_name : null;
        $userRole = (Request::user()) ? Request::user()->is_admin : null;
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
