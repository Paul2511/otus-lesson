<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\Users\Handlers\UserCreateHandler;
use App\Services\Users\Handlers\UserDeleteHandler;
use App\Services\Users\Handlers\UserUpdateHandler;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserStatusRepository;
use App\Services\Users\Repositories\UserTypeRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class UserService
{
    /**
     * @var UserCreateHandler
     */
    private $createHandler;
    /**
     * @var UserUpdateHandler
     */
    private $updateHandler;
    /**
     * @var UserDeleteHandler
     */
    private $deleteHandler;
    /**
     * @var UserStatusRepository
     */
    private $statusRepository;
    /**
     * @var UserTypeRepository
     */
    private $typeRepository;
    /**
     * @var EloquentUserRepository
     */
    private $userRepository;

    public function __construct(UserCreateHandler $createHandler, UserUpdateHandler $updateHandler, UserDeleteHandler $deleteHandler, UserStatusRepository $statusRepository, UserTypeRepository $typeRepository, EloquentUserRepository $userRepository)
    {
        $this->createHandler = $createHandler;
        $this->updateHandler = $updateHandler;
        $this->deleteHandler = $deleteHandler;
        $this->statusRepository = $statusRepository;
        $this->typeRepository = $typeRepository;
        DB::class;
        $this->userRepository = $userRepository;
    }


    public function createByArray(array $data): ?User
    {
        return $this->createHandler->handle($data);
    }

    /**
     * @param User $user
     * @param array $data
     */
    public function updateByArray(User $user, array $data): void
    {
        $this->updateHandler->handle($user, $data);
    }

    public function delete(User $user): void
    {
        $this->deleteHandler->handle($user);
    }

    /**
     * @return array
     */
    public function getTypeUsers(): array
    {
        return $this->typeRepository->getTypes();
    }

    /**
     * @return array
     */
    public function getStatusUsers(): array
    {
        return $this->statusRepository->getStatuses();
    }


    /**
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return $this->userRepository->newQuery();
    }
}