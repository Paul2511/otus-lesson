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
    $roles = [0, 10, 20];
    foreach ($roles as $role)
        {
        DB::table('roles')->insert(['name' => $role]);
        }
    }


}
