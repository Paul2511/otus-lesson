<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Console\Commands;

use App\Services\Users\DTO\CreateUserDTO;
use App\Services\Users\UserCreateService;
use Illuminate\Console\Command;


class CreateUser extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user with dummy surveys';

    private string $userName;
    private string $userEmail;
    private string $userPassword;
    private bool $createDummy = false;
    private bool $userIsAdmin = false;
    private bool $userIsModerator = false;

    public function getUserCreateService(): UserCreateService
    {
        return app(UserCreateService::class);
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->handleUserInput();
        $this->getUserCreateService()
            ->handle(
                CreateUserDTO::initFromArray(
                    [
                        "name" => $this->userName,
                        "email" => $this->userEmail,
                        "password" => $this->userPassword,
                        "isAdmin" => $this->userIsAdmin,
                        "isModerator" => $this->userIsModerator,
                    ]
                ),
                $this->createDummy,
            );
    }

    private function handleUserInput()
    {
        $this->userName = $this->ask('Enter user name', 'test');
        $this->userEmail = $this->ask('Enter user email', 'test@example.com');
        $this->userPassword = $this->secret('Enter user password [default: 123456]') ?? '123456';

        $this->userIsAdmin = $this->confirm('Is user admin?', false);
        $this->userIsAdmin ||
        ($this->userIsModerator = $this->confirm('Is user moderator?', false));

        $this->createDummy = $this->confirm('Create dummy survey?', true);
    }
}
