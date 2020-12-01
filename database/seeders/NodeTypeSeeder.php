<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NodeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO
                        node_types (name, title)
                    VALUES
                        ('note', 'Note'),
                        ('simple-task', 'Simple Task'),
                        ('document', 'Document'),
                        ('task', 'Task')"
        );
    }
}
