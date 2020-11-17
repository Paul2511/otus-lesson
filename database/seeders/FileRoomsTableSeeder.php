<?php

namespace Database\Seeders;

use App\Models\FileRoom;
use Illuminate\Database\Seeder;

class FileRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileRoom::factory(20)->create();
    }
}
