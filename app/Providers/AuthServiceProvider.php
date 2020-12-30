<?php

namespace App\Providers;
use App\Models\{User, Todo, Task, Knowledge, Comment, Client};
use App\Policies\{UserPolicy, TodoPolicy, TaskPolicy, KnowledgePolicy, CommentPolicy, ClientPolicy};
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
        User::class => UserPolicy::class,
        Todo::class => TodoPolicy::class,
        Task::class => TaskPolicy::class,
        Knowledge::class => KnowledgePolicy::class,
        Comment::class => CommentPolicy::class,
        Client::class => ClientPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
