<?php


namespace App\Services\Users\Handlers;

use App\Jobs\User\UserDetailAvatarThumbnailJob;
use App\Models\User;
use App\Services\Files\DTO\ImageData;
use App\Services\Users\Repositories\UserDetailRepository;
use App\Services\Users\Repositories\UserRepository;

use App\Helpers\LogHelper;

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

    //todo data через DTO
    public function handle(int $id, array $data): User
    {
        $user = $this->userRepository->findUser($id);
        $detail = $user->userDetail;

        $result = true;
        $isLogged = false;

        $newUser = $data;
        $newDetail = $data['detail'] ?? null;

        \DB::beginTransaction();

        if ($newDetail && isset($newDetail['avatar'])) {
            $avatar = ImageData::fromArray($newDetail['avatar']);
            if ($avatar->path && $avatar->path != $detail->avatar->path) {
                UserDetailAvatarThumbnailJob::dispatch($detail, $avatar);
            }
        }

        if ($newDetail) {
            unset($newUser['detail']);

            try {
                $result = $this->userDetailRepository->setUserDetail($detail, $newDetail);
            } catch (\Exception $e) {

                LogHelper::slack("Ошибка обновления user detail #{$user->id}", [
                    'userId'=>auth()->user()->getAuthIdentifier(),
                    'error'=>$e->getMessage(),
                    'detailData'=>$newDetail
                ]);
                $isLogged = true;
                $result = false;
            }

        }

        if ($result && count($newUser)) {

            //Есть определенные системные поля, редактировать которых может только админ
            $isSystem = collect($newUser)->contains(function ($val, $key){
                return in_array($key, self::$userSystemFields);
            });
            if ($isSystem) {
                \Gate::authorize('update-user-system-fields');
            }

            try {
                $result = $this->userRepository->setUser($user, $newUser);
            } catch (\Exception $e) {

                LogHelper::slack("Ошибка обновления user #{$user->id}", [
                    'userId'=>auth()->user()->getAuthIdentifier(),
                    'error'=>$e->getMessage(),
                    'userData'=>$newUser
                ]);
                $isLogged = true;
                $result = false;
            }
        }
        if ($result) {
            \DB::commit();
            $user->fresh();
        } elseif (!$isLogged) {
            LogHelper::slack("Ошибка обновления пользователя #{$user->id}", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'data'=>$data
            ]);
        }

        return $user;
    }
}