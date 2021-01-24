<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Support\Phone\Fakers\PhoneNumberProvider;
use Support\Person\PersonName\PersonNameData;
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

        $sex = $this->faker->randomElement(['male', 'female']);
        $name = PersonNameData::fromArray([
            'lastName' => $this->faker->lastName($sex),
            'firstName' => $this->faker->firstName($sex),
            'middleName' => $this->faker->middleName($sex)
        ])->fullName;

        //Добавляем свой формат на номер телефона
        $this->faker->addProvider(new PhoneNumberProvider($this->faker));

        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => $hash,
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber,
            'locale' => \App::currentLocale()
        ];
    }
}
