<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'role' => Role::ROLE_ADMIN,
            'email' => 'admin@admin.admin',
            'password' => Hash::make('admin'),
            'region_id' => 4,
        ]);
        User::factory()->times(10)->create();
    }
}
