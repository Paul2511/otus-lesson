<?php

namespace App\Console\Commands\Users;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admins;

class CreateAdmin extends Command
{
    protected $signature = 'users:create:admin {login=admin} {email=admin@admin.ru} {password=admin} --send-email';

    protected $description = 'Create admin';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        User::create([
            'login' => $this->argument('login'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
            'level' => User::LEVEL_ADMIN
        ]);
        
        if($this->option('send-email')){
            $data = ['login' => $this->argument('login'),
                     'email' => $this->argument('email'),
                     'password' => $this->argument('password')
                ];
            Mail::to($this->argument('email'))->send(new Admins($data));
        }
        
        $this->info('Admin has been created');
        return 0;
    }
}
