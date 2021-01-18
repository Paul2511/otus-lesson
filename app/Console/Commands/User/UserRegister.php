<?php

namespace App\Console\Commands\User;

use App\Services\DTO\User\UserRegisterData;
use App\Services\Users\Helpers\UserLabelsHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Services\Users\UserService;
use Illuminate\Support\Facades\Validator;

class UserRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:register
                            {role : The role of the user (client, spec, manager, admin)}
                            {--email= : The email of the user}
                            {--phone= : The phone number of the user}
                            {--p|--password : Specify password}
                            {--send : Do send email with credentials}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registering a user with the selected role';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    private function _getUserService(): UserService
    {
        return app(UserService::class);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $role = $this->argument('role');

        $availableRoles = UserLabelsHelper::roleLabels();

        if (!in_array($role, array_keys($availableRoles))) {
            $this->error("The role {$role} is not supported!");
            return 1;
        }

        $email = $this->option('email') ?? $this->ask('Email');

        $specifyPassword = $this->option('password');
        $password = null;
        if ($specifyPassword) {
            $password = $this->secret('Password (skip to generate random)');
        }
        if (!$specifyPassword || !$password) {
            $password = Str::random(5);
        }

        $phone = $this->option('phone');

        $send = $this->option('send');

        $data = [
            'role'=>$role,
            'email'=>$email,
            'password'=>$password,
            'phone'=>$phone,
            'sendWelcomeEmail'=>$send
        ];

        $validator = Validator::make($data, [
            'password' => 'required|min:5',
            'email' => ['email','required'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        $userService = $this->_getUserService();

        $userData = new UserRegisterData($data);

        $user = $userService->registerUser($userData);

        if (!$user) {
            $this->error('An error occurred while registering a user');
            return 1;
        }

        $this->info("Successfully registered user with id {$user->id}");

        return 0;
    }
}
