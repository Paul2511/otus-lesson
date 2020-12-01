<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Model;
use App\Models\PriceType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PriceTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PriceType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'code' => Str::random(10),
            'short_text' => $this->faker->text(100),
            'country_id' => Country::all()->random()->id,
            'status' => $this->faker->randomElement([PriceType::STATUS_ACTIVE, PriceType::STATUS_INACTIVE]),
        ];
    }
}
