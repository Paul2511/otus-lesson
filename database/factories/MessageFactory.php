<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fake = $this->faker->unique();
        $text = $fake->realText();

        $creator = User::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();
        $chat = Room::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();

        return [
            'text_view' => $text,
            'text_raw' => $text,

            'room_id' => $chat->id,
            'creator_id' => $creator->id,
        ];
    }
}
