<?php

use App\Models\Chat;
use App\Models\File;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()->pluck('id')->toArray();
        $chatIds = Chat::query()->pluck('id')->toArray();
        $fileIds = File::query()->pluck('id')->toArray();

        $messages = factory(Message::class, 20)->make()->each(function ($message) use ($userIds, $chatIds) {
            factory(Message::class)->make();
            $message->user_id = (int)array_rand(array_flip($userIds));
            $message->chat_id = (int)array_rand(array_flip($chatIds));
        })->toArray();

        Message::query()->insert($messages);
        Message::query()->each(function ($q) use ($fileIds) {
            $q->files()->attach(array_rand(array_flip($fileIds)));
        });
    }
}
