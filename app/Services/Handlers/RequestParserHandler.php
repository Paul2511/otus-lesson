<?php

namespace App\Services\Handlers;

use Illuminate\Http\Request;

class RequestParserHandler
{
    static $except = [
        'password',
        'confirmation'
    ];

    public static function handle(Request $request): array
    {
        $route = $request->route();
        $controller = $route->getActionName();
        $params = $request->except(self::$except);
        $userName = ($request->user()) ? $request->user()->full_name : null;
        $userRole = ($request->user()) ? $request->user()->is_admin : null;
        $userAgent = $request->userAgent();
        $ip = $request->ip();

        $context = [
            'Controller' => $controller,
            'Params' => json_encode($params, JSON_UNESCAPED_UNICODE),
            'User' => $userName,
            'Role' => $userRole,
            'User Agent' => $userAgent,
            'IP' => $ip,
            'Method' => $request->getMethod(),
        ];

        return $context;
    }

}
