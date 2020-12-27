<?php


namespace App\Services\Users\Repositories;


use App\Models\User;

class UserStatusRepository
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
    public function getStatuses(): array
    {
        return [
            $this->user::STATUS_DELETED => __('users.status-deleted'),
            $this->user::STATUS_LOCKED => __('users.status-locked'),
            $this->user::STATUS_INACTIVE => __('users.status-inactive'),
            $this->user::STATUS_ACTIVE => __('users.status-active'),
        ];
    }

}
