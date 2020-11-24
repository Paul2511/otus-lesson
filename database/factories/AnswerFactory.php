<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'correct' => rand(1, 10) % 2 === 1,

            'text' => $this->faker->paragraph(4),

            'pictures' =>
                [
                    $this->faker->imageUrl(),
                    $this->faker->imageUrl(),
                    $this->faker->imageUrl(),
                ],
        ];
    }
}
