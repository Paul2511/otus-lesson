<?php /** @noinspection PhpUnreachableStatementInspection */


namespace App\Services;


use App\Models\User;
use App\Services\Handlers\CreateUserHandler;
use App\Services\Handlers\DeleteUserHandler;
use App\Services\Handlers\PaginateUsersHandler;
use App\Services\Handlers\FindUserHandler;
use App\Services\Handlers\UpdateUserHandler;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Translators\UserRolesTranslator;
use App\Services\Users\Translators\UserStatusesTranslator;
use Illuminate\Pagination\LengthAwarePaginator;


class UsersService
{
    private $userStatusTranslator;
    private $userRolesTranslator;
    private $createUserHandler;
    private $paginateUsersHandler;
    private $findUserHandler;
    private $updateUserHandler;
    private $deleteUserHandler;
    private $eloquentUserRepository;


    /**
     * UsersService constructor.
     * @param UserStatusesTranslator $userStatusTranslator
     * @param UserRolesTranslator $userRolesTranslator
     * @param CreateUserHandler $createUserHandler
     * @param PaginateUsersHandler $paginateUsersHandler
     * @param FindUserHandler $findUserHandler
     * @param UpdateUserHandler $updateUserHandler
     * @param DeleteUserHandler $deleteUserHandler
     * @param EloquentUserRepository $eloquentUserRepository
     */
    public function __construct(

        UserStatusesTranslator $userStatusTranslator,
        UserRolesTranslator $userRolesTranslator,
        CreateUserHandler $createUserHandler,
        PaginateUsersHandler $paginateUsersHandler,
        FindUserHandler $findUserHandler,
        UpdateUserHandler $updateUserHandler,
        DeleteUserHandler $deleteUserHandler,
        EloquentUserRepository $eloquentUserRepository

    )
    {
        $this->userStatusTranslator = $userStatusTranslator;
        $this->userRolesTranslator = $userRolesTranslator;
        $this->createUserHandler = $createUserHandler;
        $this->paginateUsersHandler = $paginateUsersHandler;
        $this->findUserHandler = $findUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->deleteUserHandler = $deleteUserHandler;
        $this->eloquentUserRepository = $eloquentUserRepository;

    }

    public function translateStatuses(string $lang): array
    {
        return $this->userStatusTranslator->translate($lang);
    }

    public function translateRoles(string $lang): array
    {
        return $this->userRolesTranslator->translate($lang);
    }

    public function createUser($data)
    {
        return $this->createUserHandler->handle($data);
    }

    public function paginateUsers(int $perPage)
    {
        return $this->paginateUsersHandler->handle($perPage);
    }

    public function findUserWithRelations(int $id): User
    {
        return $this->eloquentUserRepository->findUserByIdWithRelations($id, [
            'role', 'companies'
        ]);
    }

    public function updateUser(int $id, array $data)
    {
        return $this->updateUserHandler->handle($id, $data);
    }

    public function deleteUser(int $id)
    {
        return $this->deleteUserHandler->handle($id);
    }

}