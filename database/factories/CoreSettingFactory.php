<?php

namespace Database\Factories;

use App\Models\CoreSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoreSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoreSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key' => $this->faker->unique()->slug,
            'value' => $this->faker->words(3, true),
        ];
    }
}
