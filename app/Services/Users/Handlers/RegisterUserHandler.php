<?php


namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Models\UserDetail;
use App\Services\DTO\User\UserRegisterData;
use App\Services\Users\Repositories\UserDetailRepository;
use App\Services\Users\Repositories\UserRepository;
use App\Helpers\LogHelper;
use Hash;

class RegisterUserHandler
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

    /**
     * @param UserRegisterData $data
     * @return User|null
     * @throws \Throwable
     */
    public function handle(UserRegisterData $userRegisterData)
    {
        \DB::beginTransaction();

        $clientPassword = $userRegisterData->password;
        $userRegisterData->password = Hash::make($clientPassword);

        $data = $userRegisterData->toArray();

        try {
            $user = $this->userRepository->createUser($data);

            $classifier = $this->getUserDetailDefaultClassifier($user->role);

            $detailData = [
                'user_id' => $user->id,
                'classifier' => $classifier
            ];
            $this->userDetailRepository->createUserDetail($detailData);
            \DB::commit();

            $user->clientPassword = $clientPassword;

            \Log::channel('registration')->info('Новая регистрация пользователя', [
                'id'=>$user->id,
                'role'=>$user->role,
                'email'=>$user->email,
                'password'=>$clientPassword
            ]);
            $user->refresh();
            return $user;
        } catch (\Throwable $e) {
            \DB::rollBack();

            LogHelper::slack("Ошибка регистрации пользователя", [
                'error'=>$e->getMessage(),
                'userData'=>$data
            ]);

            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getUserDetailDefaultClassifier(string $role)
    {
        switch ($role) {
            case User::ROLE_CLIENT:
                $classifier = UserDetail::CLASSIFIER_CLIENT_TARGET;
                break;
            case User::ROLE_SPEC:
                $classifier = UserDetail::CLASSIFIER_SPEC_NOT_ALLOWED;
                break;
            default:
                $classifier = null;
                break;
        }

        return $classifier;
    }
}