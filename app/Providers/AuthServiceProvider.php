<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Promotion;
use App\Policies\PromotionyPolicy;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Promotion::class => PromotionyPolicy::class,
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
    
    public function registerGates(): void {
        Gate::define(\App\Policies\Permission::GATE_PROMOTION, '\App\Policies\PromotionGate@view');
    }
}
