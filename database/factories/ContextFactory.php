<?php

namespace Database\Factories;

use App\Models\Context;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContextFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Context::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value'   => $this->faker->word,
            'prefix'  => $this->faker->word,
            'postfix' => $this->faker->word,
        ];
    }
}
