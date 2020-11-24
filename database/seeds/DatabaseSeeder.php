<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(FileSeeder::class);
        $this->call(ChatSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(NotificationUserSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(CardUserSeeder::class);
        $this->call(TimeSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(GymSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ScheduleUserSeeder::class);
    }
}
