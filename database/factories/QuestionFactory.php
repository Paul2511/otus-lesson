<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;


class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return
            [
                'name'     => $this->faker->text('40'),
                'text'     => $this->faker->text('120'),
                'pictures' =>
                    [
                        $this->faker->imageUrl(),
                        $this->faker->imageUrl(),
                        $this->faker->imageUrl(),
                    ],
                'type'     => array_rand(
                    [
                        Question::TYPE_CHECKBOX,
                        Question::TYPE_RADIO,
                    ]
                ),
            ];
    }
}
