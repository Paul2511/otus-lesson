<?php


namespace App\Services\Users\Handlers;


use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;

class UserUpdateHandler
{
    /**
     * @var EloquentUserRepository
     */
    private $repository;

    public function __construct(EloquentUserRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * @param User $user
     * @param array $data
     */
    public function handle(User $user, array $data): void
    {
        $this->repository->updateByArray( $data,$user->id);
    }
}
