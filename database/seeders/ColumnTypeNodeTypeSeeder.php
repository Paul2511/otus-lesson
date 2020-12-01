<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColumnTypeNodeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO
                        column_type_node_type (column_type_id, node_type_id)
                    VALUES
                        (1, 1),
                        (1, 2),
                        (2, 2),
                        (3, 2),
                        (4, 3),
                        (4, 4),
                        (2, 4),
                        (3, 4)"
        );
    }
}
