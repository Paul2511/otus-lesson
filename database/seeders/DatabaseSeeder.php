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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TokensTableSeeder::class);
        $this->call(FilesTableSeeder::class);
        $this->call(CoreSettingsTableSeeder::class);
        $this->call(UserSettingsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(RoomUsersTableSeeder::class);
        $this->call(FileRoomsTableSeeder::class);
        $this->call(ReactionsTableSeeder::class);
        $this->call(SearchContentsTableSeeder::class);
        $this->call(SmsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
    }
}
