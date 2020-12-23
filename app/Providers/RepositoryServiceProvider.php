<?php


namespace App\Providers;


use App\Services\Permissions\Repository\EloquentPermissionRepository;
use App\Services\Permissions\Repository\Interfaces\EloquentPermissionRepositoryInterface;
use App\Services\Roles\Repository\EloquentRoleRepository;
use App\Services\Users\Repository\EloquentUserRepository;
use App\Services\Users\Repository\Interfaces\EloquentUserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(EloquentPermissionRepositoryInterface::class,EloquentPermissionRepository::class);
        $this->app->bind(EloquentRoleRepository::class,EloquentRoleRepository::class);
        $this->app->bind(EloquentUserRepositoryInterface::class,EloquentUserRepository::class);

    }

}
