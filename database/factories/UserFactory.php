<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Fakers\CustomPhoneProvider;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //Предустанавливаем всем фейковым пользователям один пароль
        $password = env('USER_TEST_PASSWORD');
        $hash = Hash::make($password);

        //Добавляем свой формат на номер телефона
        $this->faker->addProvider(new CustomPhoneProvider($this->faker));

        return [
            //'name' => $this->faker->name,
            'name' => '-', //В нашей системе ФИО распологается в UserDetail
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => $hash,
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber
        ];
    }
}
