<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\SearchContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class SearchContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SearchContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fake = $this->faker;

        $post = Post::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();

        return [
            'title' => $post->name_view,
            'content' => $post->text_raw,
            'entity_type' => 'POST',
            'entity_id' => $post->id,
            'path' => $fake->url,
            'weight' => $fake->randomNumber(),
        ];
    }
}

