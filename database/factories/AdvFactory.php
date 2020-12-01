<?php

namespace Database\Factories;

use App\Models\Adv;
use App\Models\City;
use App\Models\Country;
use App\Models\PriceType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function GuzzleHttp\Psr7\str;

class AdvFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adv::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(200),
            'slug' => Str::random(200),
            'description' => $this->faker->text,
            'place' => Str::random(255),
            'picture' => Str::random(200),
            'price' => $this->faker->numberBetween(100, 200000),
            'status' => $this->faker->randomElement([Adv::STATUS_ACTIVE, Adv::STATUS_INACTIVE, Adv::STATUS_CLOSED]),
            'type_adv' => $this->faker->randomElement([Adv::TYPE_LOOKING, Adv::TYPE_PROVIDING]),
            'user_id' => User::all()->random()->id,
            'price_type_id' => PriceType::all()->random()->id,
            'city_id' => City::all()->random()->id,
            'section_id' => Country::all()->random()->id,
        ];
    }
}
