<?php

namespace Database\Factories;

use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class SurveyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Survey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $item =
            [
                'name'    => $this->faker->text('40'),
                'text'    => $this->faker->text('120'),
                'picture' => $this->faker->imageUrl(),
            ];

        // dd($item);

        return $item;
    }
}
