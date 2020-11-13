<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payload = [
            ['title' => 'User'],
            ['title' => 'Admin'],
        ];

        foreach ($payload as $item) {
            Role::factory()->create($item);
        }
    }
}
