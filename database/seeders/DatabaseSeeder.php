<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ColumnTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TaskTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
    }
}
