<?php


namespace App\Providers;

use App\Services\Columns\Repository\EloquentColumnRepository;
use App\Services\Columns\Repository\Interfaces\EloquentColumnRepositoryInterfaces;
use App\Services\Permissions\Repository\EloquentPermissionRepository;
use App\Services\Permissions\Repository\Interfaces\EloquentPermissionRepositoryInterface;
use App\Services\Roles\Repository\EloquentRoleRepository;
use App\Services\Roles\Repository\Interfaces\EloquentRoleRepositoryInterface;
use App\Services\UserRole\Repository\EloquentUserRoleRepository;
use App\Services\UserRole\Repository\Interfaces\EloquentUserRoleRepositoryInterface;
use App\Services\Users\Repository\EloquentUserRepository;
use App\Services\Users\Repository\Interfaces\EloquentUserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(EloquentPermissionRepositoryInterface::class,EloquentPermissionRepository::class);
        $this->app->bind(EloquentRoleRepositoryInterface::class,EloquentRoleRepository::class);
        $this->app->bind(EloquentUserRepositoryInterface::class,EloquentUserRepository::class);
        $this->app->bind(EloquentColumnRepositoryInterfaces::class,EloquentColumnRepository::class);
        $this->app->bind(EloquentUserRoleRepositoryInterface::class,EloquentUserRoleRepository::class);


    }

}
