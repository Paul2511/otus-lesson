<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\DictionaryPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('show-dictionary', [DictionaryPolicy::class, 'isOwnDictionary']);
        Gate::define('destroy-dictionary', [DictionaryPolicy::class, 'isOwnDictionary']);

        Gate::define('store-word', [DictionaryPolicy::class, 'isOwnDictionary']);
        Gate::define('destroy-word', [DictionaryPolicy::class, 'isOwnDictionary']);
    }
}
