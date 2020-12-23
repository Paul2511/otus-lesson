<?php


namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\UserDetailRepository;
use App\Services\Users\Repositories\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;

class UpdateUserHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserDetailRepository
     */
    private $userDetailRepository;

    private static $userSystemFields = ['status', 'role'];

    public function __construct(
        UserRepository $userRepository, UserDetailRepository $userDetailRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
    }

    public function handle(int $id, array $data): User
    {
        $user = $this->userRepository->findUser($id);
        $detail = $user->userDetail;

        $result = true;

        $newUser = $data;
        $newDetail = $data['detail'] ?? null;

        if ($newDetail) {
            unset($newUser['detail']);
            $result = $this->userDetailRepository->setUserDetail($detail, $newDetail);
        }

        if ($result && count($newUser)) {

            //Есть определенные системные поля, редактировать которых может только админ
            $isSystem = collect($newUser)->contains(function ($val, $key){
                return in_array($key, self::$userSystemFields);
            });
            if ($isSystem) {
                \Gate::authorize('update-user-system-fields');
            }

            $result = $this->userRepository->setUser($user, $newUser);
        }
        if ($result) {
            $user->fresh();
        }
        else {
            //todo: репорт ошибки
        }

        return $user;
    }
}