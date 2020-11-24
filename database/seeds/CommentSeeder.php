<?php

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()->where('role', User::ROLE_GUEST)->pluck('id')->toArray();

        $comments = factory(Comment::class, 10)->make()->each(function ($comment) use ($userIds) {
            factory(Comment::class)->make();
            $comment->user_id = array_rand(array_flip($userIds));
        })->toArray();

        Comment::query()->insert($comments);
    }
}
