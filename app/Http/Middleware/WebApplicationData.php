<?php

namespace App\Http\Middleware;

use App\Helpers\BaseHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
class WebApplicationData
{
    /**
     * Посредник формирует массив с необходимыми данными для web части приложения
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $data = [
            'locale' => App::currentLocale(),
            'defaultAvatar' => BaseHelper::getUserDefaultAvatar()
        ];

        View::share('data', $data);

        return $next($request);
    }
}
