<?php


namespace App\Services\Users;

use App\Services\Users\Helpers\UserDetailLabelsHelper;
use App\Services\Users\Repositories\UserRepository;
use App\Services\BaseService;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Helpers\UserLabelsHelper;
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

    public function __construct(
        UserRepository $userRepository,
        UpdateUserHandler $updateUserHandler,
        UserLabelsHelper $userLabelsHelper,
        UserDetailLabelsHelper $detailLabelsHelper
    )
    {
        $this->userRepository = $userRepository;
        $this->updateUserHandler = $updateUserHandler;
        $this->userLabelsHelper = $userLabelsHelper;
        $this->detailLabelsHelper = $detailLabelsHelper;
    }

    public function findUser(int $id): array
    {
        $user = $this->userRepository->findUser($id);
        $userArray = $this->userLabelsHelper->toArray($user);

        $detail = $user->userDetail;
        $detailArray = $this->detailLabelsHelper->toArray($detail);
        $userArray['detail'] = $detailArray;

        return $this->setData(['user'=>$userArray])->success()->getData();
    }

    public function setUser(int $id, $data): array
    {
        $user = $this->updateUserHandler->handle($id, $data);
        $userArray = $this->userLabelsHelper->toArray($user);

        $detail = $user->userDetail;
        $detailArray = $this->detailLabelsHelper->toArray($detail);
        $userArray['detail'] = $detailArray;

        $result = $this->setData(['user'=>$userArray])->success()->saveMessage()->getData();

        return $result;
    }
}