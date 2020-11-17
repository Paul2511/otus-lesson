<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $creator = User::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();

        return [
            'key' => $this->faker->unique()->slug,
            'value' => $this->faker->words(3, true),
            'user_id' => $creator->id,
        ];
    }
}
