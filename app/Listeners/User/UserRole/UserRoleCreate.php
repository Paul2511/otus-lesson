<?php


namespace App\Listeners\User\UserRole;

use App\Events\User\UserEvent;
use App\Events\User\UserRoleCreated;
use App\Listeners\User\UserSend\UserSendWelcomeMsg;
use Illuminate\Support\Str;
class UserRoleCreate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        $user = $event->getUser();
        $role = $user->role->getValue();

        $className = self::class . Str::ucfirst($role);

        /** @var UserRoleCreateInterface $class */
        $class = new $className();

        $class->handle($user);

        //Отправка письма
        UserRoleCreated::dispatch($user);
    }
}