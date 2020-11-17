<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\FileRoom;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileRoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FileRoom::class;

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
        $attach = File::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();
        $chat = Room::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();
        $message = Message::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();

        return [
            'creator_id' => $creator->id,
            'room_id' => $chat->id,
            'message_id' => $message->id,
            'file_id' => $attach->id,
        ];
    }
}
