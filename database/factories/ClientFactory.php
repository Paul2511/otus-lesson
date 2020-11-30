<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'last_name'=> $this->faker->name,
            'patronymic'=> $this->faker->name,
            'interest_status' => 'want service',
            'email' => $this->faker->unique()->safeEmail,
            'addres' => 'unreal place',
            'phone' => '9999999999',
            'wishes'=> 'some wishes',
            'complaints' => 'none',
            'selected_service' => $this->faker->paragraph,
            'user_id' => rand(1,3)
        ];
    }
}
