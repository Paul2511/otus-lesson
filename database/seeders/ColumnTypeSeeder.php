<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColumnTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO
                        column_types (name, title)
                    VALUES
                        ('detail', 'Detail'),
                        ('deadline', 'Deadline'),
                        ('status', 'Status'),
                        ('description', 'Description')"
        );
    }
}
