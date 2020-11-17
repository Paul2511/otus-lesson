<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\RoomUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoomUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $message = Message::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();

        return [
            'user_id' => $message->creator_id,
            'room_id' => $message->room_id,
            'is_owner' => 1,
            'muted' => 0,
            'ban' => 0,
            'message_first_id' => $message->id,
            'message_read_id' => $message->id,
            'message_last_id' => $message->id,
        ];
    }
}
