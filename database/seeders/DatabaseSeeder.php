<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call([
        	UserSeeder::class,
        	TaskSeeder::class,
        	TodoSeeder::class,
        	ClientSeeder::class,
        	KnowledgeSeeder::class,
        	CommentSeeder::class
    	]);
        // \App\Models\User::factory(10)->create();
    }
}
