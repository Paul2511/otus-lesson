<?php


namespace App\Services\Users;

use App\Services\Users\Repositories\UserRepository;
use App\Services\BaseService;
class UserService extends BaseService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function getUser(int $id): array
    {
        $user = $this->userRepository->getUserWithDetail($id);

        return ['user'=>$user->toArray()];
    }

    public function setUser(int $id, $data): array
    {
        $user = $this->userRepository->getUser($id);

        $newUser = $this->userRepository->setUserWithDetail($user, $data);

        return $this->success(['user'=>$newUser]);
    }
}