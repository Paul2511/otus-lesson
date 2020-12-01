<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO
                        group_types (name, title)
                    VALUES
                        ('space', 'Space'),
                        ('folder', 'Folder'),
                        ('simple-list', 'Simple List'),
                        ('task-list', 'Task List')"
        );
    }
}
