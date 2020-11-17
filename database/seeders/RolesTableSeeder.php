<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::factory(10)->create();
        Role::factory(1)
            ->create([
                'level' => Role::LEVEL_USER,
                'description' => 'All users',
            ]);
        Role::factory(1)
            ->create([
                'level' => Role::LEVEL_REDACTOR,
                'description' => 'Redactors',
            ]);
        Role::factory(1)
            ->create([
                'level' => Role::LEVEL_MODERATOR,
                'description' => 'Moderators',
            ]);
        Role::factory(1)
            ->create([
                'level' => Role::LEVEL_ADMIN,
                'description' => 'Administrators',
            ]);
    }
}
