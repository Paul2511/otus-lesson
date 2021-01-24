<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use App\Services\Files\Helpers\SrcHelper;
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
            'defaultAvatar' => SrcHelper::getUserDefaultAvatar()
        ];

        $userStatuses = [];
        User::getStatesFor('status')->each(function (string $status) use (&$userStatuses) {
            $userStatuses[$status] = trans('user.status.'.$status);
        });

        $data['userStatuses'] = $userStatuses;

        View::share('data', $data);

        return $next($request);
    }
}
