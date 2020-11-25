<?php

namespace Database\Seeders;

use App\Models\Role;
use DB;
use Hash;
use Carbon\Carbon;
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
    $roles = [Role::ROLE_USER, Role::ROLE_MANAGER, Role::ROLE_ADMIN];
    $slugs = ['messages.roles.user','messages.roles.manager','messanger.roles.admin'];
    foreach ($roles as $role)
        {
        DB::table('roles')->insert(['name' => $role]);
        }
    }


}
