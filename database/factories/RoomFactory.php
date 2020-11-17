<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $creator = User::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();

        return [
            'title' => $this->faker->unique()->words(3, true),
            'creator_id' => $creator->id,
        ];
    }
}

