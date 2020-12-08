<?php


namespace App\Services\Users\Handlers;


use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;

class UserDeleteHandler
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
     */
    public function handle(User $user): void
    {
        $this->repository->deleteById($user->id);
    }
}


