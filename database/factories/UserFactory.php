<?php

namespace Database\Factories;

use Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'inn' => User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->firstName,
            'position' => $this->faker->jobTitle,
            'phone' => $this->faker->unique()->numberBetween(9990000000,9999999999),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'otp' => $this->faker->unique()->numberBetween(1000,9999),
            'status' => $this->faker->randomElement([
                User::STATUS_INACTIVE,
                User::STATUS_ACTIVE,
                User::STATUS_PENDING,
                User::STATUS_DELETED,
            ]),
            'email_verified_at' => now(),
            'remember_token' => Hash::make('token'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
