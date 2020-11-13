<?php

namespace Database\Seeders;

use App\Models\Column;
use Illuminate\Database\Seeder;

class ColumnTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payload = [
            ['title' => 'ToDo'],
            ['title' => 'InProgress'],
            ['title' => 'Done'],
        ];

        foreach ($payload as $item) {
            Column::factory()->create($item);
        }
    }
}
