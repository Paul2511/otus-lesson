<?php


namespace App\Services\Users\Repositories;


use App\Models\User;

class UserTypeRepository
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
}
