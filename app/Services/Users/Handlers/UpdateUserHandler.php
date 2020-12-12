<?php


namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\UserDetailRepository;
use App\Services\Users\Repositories\UserRepository;
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
        if (
            $this->userRepository->setUser($user, $data)
            &&
            $this->userDetailRepository->setUserDetail($detail, $data['detail'])
        )
        {
            $user->fresh();
        }
        else {
            //todo: репорт ошибки
        }

        return $user;
    }
}