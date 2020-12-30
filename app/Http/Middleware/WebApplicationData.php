<?php

namespace App\Http\Middleware;

use App\Helpers\BaseHelper;
use App\Helpers\UploadHelper;
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
            'defaultAvatar' => [
                'src'=>BaseHelper::getUserDefaultAvatar(),
                'type'=>UploadHelper::TYPE_DEFAULT
            ]
        ];

        View::share('data', $data);

        return $next($request);
    }
}
