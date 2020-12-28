<?php

namespace App\Services\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;

class FindUserByEmailHandler
{
    private EloquentUserRepository $eloquentUserRepository;

    public function __construct(EloquentUserRepository $eloquentUserRepository)
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
    }

    public function handle(string $email): ?User
    {
      return  $this->eloquentUserRepository->findByEmail($email);
    }
}
