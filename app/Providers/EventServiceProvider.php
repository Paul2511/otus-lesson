<?php

namespace App\Providers;

use App\Events\Pet\PetCreated;
use App\Events\Pet\PetDeleted;
use App\Events\Pet\PetUpdated;
use App\Events\PetType\PetTypeDeleted;
use App\Events\Specialization\SpecializationDeleted;
use App\Events\User\UserCreated;
use App\Events\User\UserRoleCreated;
use App\Listeners\Pet\PetCacheClear;
use App\Listeners\PetType\PetTypeDeleteListener;
use App\Listeners\Specialization\SpecializationDeleteListener;
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

        PetCreated::class => [
            PetCacheClear::class
        ],

        PetUpdated::class => [
            PetCacheClear::class
        ],

        PetDeleted::class => [
            PetCacheClear::class
        ],

        PetTypeDeleted::class => [
            PetTypeDeleteListener::class
        ],

        SpecializationDeleted::class => [
            SpecializationDeleteListener::class
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
