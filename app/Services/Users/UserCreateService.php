<?php


namespace App\Services\Users;


use App\Models\Answer;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;


class UserCreateService
{
    const DUMMY_SURVEYS_COUNT   = 10;
    const DUMMY_QUESTIONS_COUNT = 15;
    const DUMMY_ANSWERS_COUNT   = 4;

    private string $name;
    private string $email;
    private string $password;
    private bool   $isAdmin     = false;
    private bool   $isModerator = false;
    private bool   $createDummy = false;
    private User   $user;

    public function handle(
        string $name,
        string $email,
        string $password,
        bool $isAdmin,
        bool $isModerator,
        bool $createDummy
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
        $this->isModerator = $isModerator;
        $this->createDummy = $createDummy;

        $this->createUser();
        if ($this->createDummy) $this->createDummyData();
    }

    private function createUser()
    {
        $this->user = User::factory(
            [
                'name'     => $this->name,
                'email'    => $this->email,
                'role'     => $this->getUserRole(),
                'password' => bcrypt($this->password),
            ]
        )
            ->create();
    }

    private function createDummyData()
    {
        $this->user || $this->createUser();

        Survey::factory()
            ->times(static::DUMMY_SURVEYS_COUNT)
            ->has(
                Question::factory()
                    ->has(Answer::factory()->count(static::DUMMY_ANSWERS_COUNT))
                    ->count(static::DUMMY_QUESTIONS_COUNT)
            )
            ->create(
                [
                    'user_id' => $this->user->id,
                ]
            );

    }

    private function getUserRole(): int
    {
        if ($this->isAdmin) return User::ROLE_ADMIN;
        if ($this->isModerator) return User::ROLE_MODERATOR;

        return User::ROLE_DEFAULT;
    }

}
