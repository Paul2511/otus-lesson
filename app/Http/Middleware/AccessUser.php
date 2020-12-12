<?php

namespace App\Http\Middleware;

use App\Services\Pets\Repositories\PetRepository;
use App\Services\Users\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class AccessUser
{
    private $_user;
    /**
     * @var UserRepository
     */
    private $userRepository;


    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->_user = Auth::user();
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $name = $request->route()->getName();

        $method = 'access'.ucfirst($name);
        if (method_exists($this, $method)) {
            $this->$method($request);
        } else {
            throw new AccessDeniedHttpException();
        }

        return $next($request);
    }

    /**
     * Проверяет права на просмотр профиля пользователя
     */
    protected function accessShowUser(Request $request)
    {
        $can = $this->_can($request, 'view');

        if (!$can) {
            throw new AccessDeniedHttpException();
        }

        return;
    }

    /**
     * Проверяет права на обновление профиля пользователя
     */
    protected function accessUpdateUser(Request $request)
    {
        $can = $this->_can($request, 'update');

        if (!$can) {
            throw new AccessDeniedHttpException();
        }

        return;
    }

    protected function _can(Request $request, $ability, string $parameter = 'id'): bool
    {
        $user = $this->_user;
        $id = $request->route()->parameter($parameter);

        $model = $this->userRepository->findUser($id);

        return !!$user && $user->can($ability, $model);
    }
}
