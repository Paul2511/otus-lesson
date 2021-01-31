<?php


namespace Tests\Generators;


use App\Models\Survey;
use App\Models\User;
use Database\Factories\SurveyFactory;
use Illuminate\Database\Eloquent\Factories\Factory;


class SurveyGenerator
{

    /**
     * @param array|null $data
     * @param mixed      $user
     *
     * @return Factory
     */
    private static function factory(?array $data = [], $user = null): Factory
    {
        if (!empty($user)) {
            $data['user_id'] = $user;
        } elseif ($user === null) {
            $data['user_id'] = UsersGenerator::generate();
        }

        return Survey::factory($data);
    }

    public static function generate(?array $data = [], ?User $user = null): Survey
    {
        return static::factory($data, $user)->create();
    }

    public static function generateRaw(?array $data = [], ?User $user = null): array
    {
        return static::factory($data, $user ?? false)->raw();
    }

}
