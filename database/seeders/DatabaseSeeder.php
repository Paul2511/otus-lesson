<?php

namespace Database\Seeders;

use App\Models\Context;
use App\Models\Dictionary;
use App\Models\User;
use App\Models\Word;
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
        $users = User::factory()
            ->has(
                Dictionary::factory()
                    ->count(3)
                    ->has(
                        Word::factory()
                            ->count(15)
                            ->has(
                                Context::factory()
                                    ->count(2)
                            )
                    )
            )
            ->count(5)
            ->create();

        $this->call([
            UserSeeder::class,
        ]);
    }
}
