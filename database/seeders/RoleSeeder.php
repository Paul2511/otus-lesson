<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Role $model
     * @return void
     */
    public function run(Role $model)
    {
        $model::factory(10)->create();
    }
}
