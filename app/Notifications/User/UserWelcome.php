<?php

namespace App\Notifications\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
class UserWelcome extends Notification implements ShouldQueue
{
    use Queueable;
    use InteractsWithQueue;

    //public $afterCommit = true;
    /**
     * @var string
     */
    protected $clientPassword;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $clientPassword)
    {

        $this->clientPassword = $clientPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function viaQueues()
    {
        return [
            'mail' => 'mail',
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  User $user
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(User $user)
    {
        return (new MailMessage)
                    ->markdown('notifications::user')
                    ->subject(__('mail.user.welcome'))
                    ->greeting(__('mail.user.welcome'))
                    ->line(__('mail.user.text'))
                    ->line('**'.__('mail.user.login'). ':** '.$user->email)
                    ->line('**'.__('mail.user.password'). ':** '.$this->clientPassword);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
