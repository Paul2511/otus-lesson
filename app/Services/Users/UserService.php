<?php


namespace App\Services\Users;

use App\Exceptions\User\UserRegisterException;
use App\Exceptions\User\UserUpdateException;
use App\Jobs\User\UserAvatarThumbnailJob;
use App\Models\User;
use App\Services\Users\Dto\UserRegisterData;
use App\Services\Users\DTO\UserUpdateData;
use App\Services\Users\Repositories\UserRepository;
use Hash;
use Illuminate\Database\Eloquent\Collection;
use Support\Log\LogHelper;

class UserService
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->repository = $userRepository;
    }

    public function findUser(int $id): User
    {
        $user = $this->repository->findById($id);

        return $user;
    }

    /**
     * @return User[]|array|\Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function getUsers(?int $perPage = null, ?bool $withRequest = false)
    {
        $repository = $this->repository;

        if ($withRequest) {
            $repository = $repository->withRequest();
        }

        $result = $perPage ? $repository->paginate($perPage) : $repository->get();

        return $result ?? [];
    }


    /**
     * @throws UserUpdateException
     */
    public function updateUser(User $user, UserUpdateData $updateData): User
    {
        \DB::beginTransaction();

        if ($updateData->avatar && $updateData->avatar->path && $updateData->avatar->path != $user->avatar->path) {
            UserAvatarThumbnailJob::dispatch($user, $updateData->avatar);
        }

        $data = $updateData->all();

        try {
            $result = $this->repository->update($user, $data);

            if (!$result) {
                throw new UserUpdateException();
            }

            \DB::commit();

            $user->refresh();
            return $user;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка обновления user #{$user->id}", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'userData'=>$data
            ]);
            throw new UserUpdateException($e->getMessage());
        }
    }

    /**
     * @throws \App\Exceptions\User\UserRegisterException
     */
    public function registerUser(UserRegisterData $userRegisterData): User
    {
        $userRegisterData->password = Hash::make($userRegisterData->password);

        $data = $userRegisterData->toArray();

        try {
            $user = $this->repository->create($data);

            LogHelper::registration('Новая регистрация пользователя', [
                'id'=>$user->id,
                'role'=>$user->role->getValue(),
                'email'=>$user->email,
                'password'=>$userRegisterData->clientPassword
            ]);

            return $user;
        } catch (\Throwable $e) {

            LogHelper::slack("Ошибка регистрации пользователя", [
                'error'=>$e->getMessage(),
                'userData'=>$data
            ]);

            throw new UserRegisterException($e->getMessage());
        }
    }
}