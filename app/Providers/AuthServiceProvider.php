<?php

namespace App\Providers;

use App\Models\Column;
use App\Models\Comment;
use App\Models\Task;
use App\Policies\ColumnPolicy;
use App\Policies\Gates;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Column::class => ColumnPolicy::class,
        Comment::class => ColumnPolicy::class,
        Task::class => TaskPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerGates();

        //
    }

    private function registerGates()
    {
        Gate::define(Gates::CAN_ADMIN, 'App\Policies\DashboardGate@admin');
    }
}
