<?php

namespace App\Services\Handlers;

use App\Models\Resource;
use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;

class CheckUserPermissionHandler
{
    private EloquentUserRepository $eloquentUserRepository;

    public function __construct(EloquentUserRepository $eloquentUserRepository)
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
    }
    public function handle(User $user, int $resource_id): bool
    {
        return $this->eloquentUserRepository->checkPermission($user,$resource_id);
    }
}
