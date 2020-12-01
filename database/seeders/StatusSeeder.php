<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO
                        statuses (node_type_id, name, title)
                    VALUES
                        (2, 'open', 'Open'),
                        (2, 'done', 'Done'),
                        (4, 'new', 'New'),
                        (4, 'open', 'Open'),
                        (4, 'in-progress', 'In Progress'),
                        (4, 'done', 'Done'),
                        (4, 'closed', 'Closed')"
        );
    }
}
