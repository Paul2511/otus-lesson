<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->randomFloat(2,0,999999),
            'billed' => now(),
            'payed' => now(),
            'status' => $this->faker->randomDigit,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
