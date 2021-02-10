<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'sort' => Article::SORT,
            'short_description' => $this->faker->realText(100, 3),
            'description' => $this->faker->paragraph,
            'meta_title' => $this->faker->name,
            'meta_description' => $this->faker->realText(100, 3),
        ];
    }
}
