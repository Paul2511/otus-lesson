<?php


namespace App\Services\Users;

use App\Services\Users\Helpers\UserDetailLabelsHelper;
use App\Services\Users\Repositories\UserRepository;
use App\Services\BaseService;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Helpers\UserLabelsHelper;
use App\Services\Users\Repositories\UserDetailRepository;
class UserService extends BaseService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UpdateUserHandler
     */
    private $updateUserHandler;
    /**
     * @var UserLabelsHelper
     */
    private $userLabelsHelper;
    /**
     * @var UserDetailLabelsHelper
     */
    private $detailLabelsHelper;
    /**
     * @var UserDetailRepository
     */
    private $detailRepository;

    public function __construct(
        UserRepository $userRepository,
        UpdateUserHandler $updateUserHandler,
        UserLabelsHelper $userLabelsHelper,
        UserDetailLabelsHelper $detailLabelsHelper,
        UserDetailRepository $detailRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->updateUserHandler = $updateUserHandler;
        $this->userLabelsHelper = $userLabelsHelper;
        $this->detailLabelsHelper = $detailLabelsHelper;
        $this->detailRepository = $detailRepository;
    }

    public function findUser(int $id): array
    {
        $user = $this->userRepository->findUser($id, true);
        $userArray = $this->userLabelsHelper->toArray($user);

        //$detail = $user->userDetail;
        $detail = $this->detailRepository->findUserDetailByUserId($id, true);
        $detailArray = $this->detailLabelsHelper->toArray($detail);
        $userArray['detail'] = $detailArray;

        return [
            'user'=>$userArray,
            'success'=>true
        ];
    }

    public function setUser(int $id, $data): array
    {
        $user = $this->updateUserHandler->handle($id, $data);
        $userArray = $this->userLabelsHelper->toArray($user);

        $detail = $user->userDetail;
        $detailArray = $this->detailLabelsHelper->toArray($detail);
        $userArray['detail'] = $detailArray;

        $message = [
            'title'=>trans('form.message.successTitle'),
            'text'=>trans('form.message.successText')
        ];
        return [
            'user'=>$userArray,
            'success'=>true,
            'message'=>$message
        ];
    }
}