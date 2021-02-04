<?php

namespace App\Console\Commands;

use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * Class MailSend
 * Команда для отправки письма пользователю с данными для входа в систему
 * @package App\Console\Commands
 */
class MailSend extends Command
{

    protected $signature = 'mail:send {user} {password}';

    protected $description = 'Send a email to a user to enter system';

    private EloquentUserRepository $eloquentUserRepository;

    public function __construct(EloquentUserRepository $eloquentUserRepository)
    {
        parent::__construct();
        $this->eloquentUserRepository = $eloquentUserRepository;
    }

    public function handle()
    {
        $user = $this->eloquentUserRepository->findById($this->argument('user'));
        Mail::send('emails.user-registry', ['user'=>$user, 'password'=>$this->argument('password')], function($message) use ($user) {
            $message->to($user->email, $user->full_name)
                    ->subject('Регистрация в личном кабинете СМАРТЕР');
            $message->from(env('EMAIL_SUPPORT'),env('NAME_EMAIL_SUPPORT'));
        });
    }


}
