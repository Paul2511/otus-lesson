<?php

namespace App\Providers;

use App\Events\Pet\PetDeleted;
use App\Events\Pet\PetUpdated;
use App\Events\User\UserCreated;
use App\Events\User\UserRoleCreated;
use App\Listeners\Pet\PetCacheClear;
use App\Listeners\User\UserSend\UserSendWelcomeMsg;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\User\UserUpdated;
use App\Listeners\User\UserCache\UserCacheClear;
use App\Listeners\User\UserRole\UserRoleCreate;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*Registered::class => [
            SendEmailVerificationNotification::class,
        ],*/

        UserCreated::class => [
            UserRoleCreate::class
        ],

        UserRoleCreated::class => [
            UserSendWelcomeMsg::class
        ],

        UserUpdated::class => [
            UserCacheClear::class
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
