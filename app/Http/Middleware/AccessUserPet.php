<?php

namespace App\Http\Middleware;

use App\Services\Pets\Repositories\PetRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class AccessUserPet
{
    private $_user;
    /**
     * @var PetRepository
     */
    private $petRepository;

    public function __construct(
        PetRepository $petRepository
    )
    {
        $this->_user = Auth::user();
        $this->petRepository = $petRepository;
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

        if (method_exists($this, $method) && !empty($this->_user)) {
            $this->$method($request);
        } else {
            throw new AccessDeniedHttpException();
        }

        return $next($request);
    }

    /**
     * Проверяет права на просмотр всех питомцев
     * @param Request $request
     */
    protected function accessViewPets(Request $request)
    {
        $user = $this->_user;

        if ($user->isAdmin || $user->isManager) {
            return;
        }

        $userId = $request->route()->parameter('userId');

        if ((int)$userId !== $user->id) {
            throw new AccessDeniedHttpException();
        }
        return;
    }

    /**
     * Проверяет права на удаление питомца
     * @param Request $request
     */
    public function accessDeletePet(Request $request)
    {
        $can = $this->_can($request, 'delete');

        if (!$can) {
            throw new AccessDeniedHttpException();
        }

        return;
    }

    protected function _can(Request $request, $ability, string $parameter = 'id'): bool
    {
        $user = $this->_user;
        $id = $request->route()->parameter($parameter);

        $model = $pet = $this->petRepository->findPet($id);

        return $user->can($ability, $model);
    }
}
