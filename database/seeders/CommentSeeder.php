<?php

namespace Database\Seeders;


use App\Models\Comment;
use Illuminate\Database\Seeder;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Comment $model
     * @return void
     */
    public function run(Comment $model)
    {
        $model::factory(150)->create();
    }
}
