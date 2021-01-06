<?php

namespace App\Providers;

use App\Events\Pet\PetDeleted;
use App\Events\Pet\PetUpdated;
use App\Listeners\Cache\PetCacheClear;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\User\UserUpdated;
use App\Listeners\Cache\UserCacheClear;
use App\Events\UserDetail\UserDetailUpdated;
use App\Listeners\Cache\UserDetailCacheClear;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserUpdated::class => [
            UserCacheClear::class
        ],
        UserDetailUpdated::class => [
            UserDetailCacheClear::class
        ],

        PetUpdated::class => [
            PetCacheClear::class
        ],

        PetDeleted::class => [
            PetCacheClear::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
