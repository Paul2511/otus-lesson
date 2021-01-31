<?php

namespace App\Services\Users;


use App\Models\Answer;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use App\Services\Users\DTO\CreateUserDTO;


class UserCreateService
{
    public const DUMMY_SURVEYS_COUNT = 10;
    public const DUMMY_QUESTIONS_COUNT = 15;
    public const DUMMY_ANSWERS_COUNT = 4;

    public function handle(
        CreateUserDTO $userData,
        bool $createDummyData = false
    ) {
        $this->createUserFromDTO($userData, $createDummyData);
    }

    private function createUserFromDTO(CreateUserDTO $userData, $createDummyData = false)
    {
        /** @var User $user */
        $user = User::factory($userData->getUserCreateArray())
            ->create();

        if ($createDummyData) {
            $this->createDummyData($user->id);
        }
    }

    private function createDummyData(int $userId)
    {
        Survey::factory()
            ->times(static::DUMMY_SURVEYS_COUNT)
            ->has(
                Question::factory()
                    ->has(Answer::factory()->count(static::DUMMY_ANSWERS_COUNT))
                    ->count(static::DUMMY_QUESTIONS_COUNT)
            )
            ->create(
                [
                    'user_id' => $userId,
                ]
            );
    }

}
