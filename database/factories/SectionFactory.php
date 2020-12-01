<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Section;
use App\Models\SectionGroup;
use DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'slug' => Str::random(255),
            'description' => $this->faker->text,
            'group_id' => SectionGroup::all()->random()->id,
            'parent_id' => null,
            'status' => $this->faker->randomElement([Section::STATUS_ACTIVE, Section::STATUS_INACTIVE]),
        ];
    }
}
