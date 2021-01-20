<?php

namespace App\Listeners\User\UserSend;

use App\Events\User\UserEvent;
use App\Notifications\User\UserWelcome;
class UserSendWelcomeMsg
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

        if (isset($user->sendWelcomeEmail) && $user->sendWelcomeEmail) {
            $user->notify(new UserWelcome($user->clientPassword)); //только с таким хуком в очереди сохраняется пользовательское поле
        }
    }
}
