<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->city,
            'slug' => Str::random(255),
            'country_id' => Country::all()->random()->id,
            'status' => $this->faker->randomElement([City::STATUS_ACTIVE, City::STATUS_INACTIVE]),
        ];
    }
}
