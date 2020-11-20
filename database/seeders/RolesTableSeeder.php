<?php

namespace Database\Seeders;

use App\Models\Role;
use DB;
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
        $roles = Role::rolesList();

        foreach ($roles as $role)
        {
            DB::table('roles')->insert(['role' => $role]);
        }
    }
}
