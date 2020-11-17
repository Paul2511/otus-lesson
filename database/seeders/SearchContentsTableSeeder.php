<?php

namespace Database\Seeders;

use App\Models\SearchContent;
use Illuminate\Database\Seeder;

class SearchContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SearchContent::factory(20)->create();
    }
}
