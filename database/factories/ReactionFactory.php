<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fake = $this->faker;

        $creator = User::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();
        $post = Post::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();

        return [
            'user_id' => $creator->id,
            'ip_address' => $fake->ipv4,
            'type' => $fake->randomElement([Reaction::TYPE_LIKE, Reaction::TYPE_DISLIKE, Reaction::TYPE_FAVORITE]),
            'entity_type' => 'POST',
            'entity_id' => $post->id,
        ];
    }
}

