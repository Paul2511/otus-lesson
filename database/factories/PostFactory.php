<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fake = $this->faker->unique();
        $name = $fake->words(6, true);
        $text = $fake->realText();

        $creator = User::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();
        $redactor = Role::query()
            ->where('level', Role::LEVEL_REDACTOR)
            ->limit(1)
            ->first()
            ->users()
            ->inRandomOrder()
            ->limit(1)
            ->first();

        return [
            'slug' => $fake->slug,
            'name_view' => $name,
            'name_raw' => $name,
            'text_view' => $text,
            'text_raw' => $text,
            'priority' => $this->faker->randomNumber(),
            'status' => Post::STATUS_ACTIVE,

            'source_link' => $this->faker->url,
            'source_label' => $this->faker->word,

            'creator_id' => $creator->id,
            'redactor_id' => $redactor->id,

            'counter_like' => 0,
            'counter_dislike' => 0,
            'counter_favorite' => 0,
            'counter_views' => 0,
        ];
    }
}

