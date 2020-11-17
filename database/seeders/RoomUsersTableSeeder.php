<?php

namespace Database\Seeders;

use App\Models\RoomUser;
use Illuminate\Database\Seeder;

class RoomUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomUser::factory(20)->create();
    }
}
