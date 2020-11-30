<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $model::factory(5)->create();
    }

    public function clearTables(Role $model): void
    {
        $tableName = $model->getTable();
        DB::table( $tableName )->delete();
        DB::statement("ALTER TABLE `{$tableName}` AUTO_INCREMENT = 1");
    }
}
