<?php


namespace App\Services\Users\Repositories;

use App\Models\User;

class EloquentUserRepository
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return [
            $this->user::TYPE_ADMIN => __('users.type-admin'),
            $this->user::TYPE_MANAGER => __('users.type-manager'),
            $this->user::TYPE_USER => __('users.type-user'),
        ];
    }

    /**
     * @return array
     */
    public function getStatuses(): array
    {
        return [
            $this->user::STATUS_DELETED => __('users.status-deleted'),
            $this->user::STATUS_LOCKED => __('users.status-locked'),
            $this->user::STATUS_INACTIVE => __('users.status-inactive'),
            $this->user::STATUS_ACTIVE => __('users.status-active'),
        ];
    }

    /**
     * @param array $data
     */
    public function createByArray(array $data): void
    {
        $this->user->create($data);
    }

    /**
     * @param User $user
     * @param array $data
     */
    public function updateByArray(User $user, array $data): void
    {
        $this->user->find($user->id)->update($data);
    }

    public function deleteById(int $id){
        $this->user->find($id)->delete();
    }
}
