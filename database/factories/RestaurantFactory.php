<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->company,
            'rating' => rand(20, 100),
            'sort' => rand(50, 100),
            'slug' => $this->faker->slug,
            'description' => $this->faker->realText(100, 3),
            'meta_title' => $this->faker->name,
            'meta_description' => $this->faker->realText(100, 3),
        ];
    }
}