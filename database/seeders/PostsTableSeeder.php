<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\TagContent;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::factory(20)->create();
        foreach($posts as $post) {
            $post
                ->tags()
                ->save(
                    Tag::query()
                        ->inRandomOrder()
                        ->limit(1)
                        ->first(),
                    ['entity_type' => TagContent::TYPE_POST]
                );
        }
    }
}
