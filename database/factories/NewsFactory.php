<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(255),
            'slug' => Str::random(255),
            'text' => $this->faker->text,
            'picture' => Str::random(200),
            'user_id' => User::all()->random()->id,
            'status' => $this->faker->randomElement([News::STATUS_ACTIVE, News::STATUS_INACTIVE]),
        ];
    }
}
