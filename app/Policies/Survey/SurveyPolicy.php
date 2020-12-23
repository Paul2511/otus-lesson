<?php

namespace App\Policies\Survey;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class SurveyPolicy extends BasePolicy
{
    use HandlesAuthorization;


    private function checkIfUserOwnsSurvey(User $user, Survey $survey): bool
    {
        return $survey->user->id === $user->id;
    }

    public function viewAny(User $user): ?bool
    {
        return true;
    }

    /**
     * Проверка, может ли пользователь просматривать чужие материалы
     *
     * @param User $user
     *
     * @return bool|null
     */
    public function viewTotallyAny(User $user): ?bool
    {
        if ($user->isModerator()) return true;

        return false;
    }

    public function view(User $user, Survey $survey): ?bool
    {
        if ($user->isModerator()) return true;

        return $this->checkIfUserOwnsSurvey($user, $survey);
    }

    public function create(User $user): ?bool
    {
        return true;
    }

    public function update(User $user, Survey $survey): ?bool
    {
        if ($user->isModerator()) return true;

        return $this->checkIfUserOwnsSurvey($user, $survey);
    }

    public function delete(User $user, Survey $survey): bool
    {
        // У модератора нет особых прав на удаление любых материалов
        // if ($user->isModerator()) return true;

        return $this->checkIfUserOwnsSurvey($user, $survey);
    }

    public function restore(User $user, Survey $survey): ?bool
    {
        if ($user->isModerator()) return true;

        return $this->checkIfUserOwnsSurvey($user, $survey);
    }

    public function forceDelete(User $user, Survey $survey): ?bool
    {
        return false;
    }
}
