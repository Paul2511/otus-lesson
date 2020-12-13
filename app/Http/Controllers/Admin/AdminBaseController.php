<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;


class AdminBaseController extends Controller
{

    const DEFAULT_PAGE_SIZE = 8;

    /**
     * Перенаправляет на страницу просмотра элемента, если он создан
     * или возвращает назад
     *
     * Принимает id созданного элемента и коллбэк, возвращающий роут, на который необходимо перейти
     * Коллбэк используется, потому что роут не должен высчитваться, если элемент не создан
     *
     * @param int      $createdElementId
     * @param callable $getRoute
     *
     * @return Application|RedirectResponse|Redirector
     */
    protected function showElementIfCreatedOrGoBack(int $createdElementId, callable $getRoute)
    {
        if ($createdElementId > 0) {
            return redirect($getRoute());
        } else {
            return redirect()->back();
        }
    }

    public function getCurrentUser(): User
    {
        return Auth::user() ?: new User;
    }

}
