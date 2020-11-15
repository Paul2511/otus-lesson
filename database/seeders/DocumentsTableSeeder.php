<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::factory()->times(10)->create();
    }
}
