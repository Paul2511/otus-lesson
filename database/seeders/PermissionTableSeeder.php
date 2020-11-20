<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payload = [
          ['title' => 'read'],
          ['title' => 'write'],
          ['title' => 'edit'],
          ['title' => 'delete'],
        ];

        foreach ($payload as $item){
            Permission::factory()->create($item);
        }
    }
}
