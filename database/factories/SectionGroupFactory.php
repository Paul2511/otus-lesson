<?php

namespace Database\Factories;

use App\Models\SectionGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SectionGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SectionGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'slug' => Str::random(20),
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement([SectionGroup::STATUS_ACTIVE, SectionGroup::STATUS_INACTIVE]),
        ];
    }
}
