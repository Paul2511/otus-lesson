<?php

namespace App\Providers;

use App\Models\Pet;
use App\Models\PetType;
use App\Models\Specialization;
use App\Policies\PetPolicy;
use App\Policies\PetTypePolicy;
use App\Models\User;
use App\Policies\SpecializationPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Pet::class => PetPolicy::class,
        PetType::class => PetTypePolicy::class,
        Specialization::class => SpecializationPolicy::class
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
