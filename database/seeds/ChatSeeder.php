<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()->where('role', User::ROLE_GUEST)->pluck('id')->toArray();

        $chats = factory(Chat::class, 10)->make()->each(function ($chat) use ($userIds) {
            factory(Chat::class)->make();
            $chat->user_id = array_rand(array_flip($userIds));
        })->toArray();

        Chat::query()->insert($chats);
    }
}
