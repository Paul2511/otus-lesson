<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleHasPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('title', 'Admin')->first();
        $userRole = Role::where('title','User')->first();

        $userPermission = Permission::where('title', 'read')->first();
        $adminPermission = Permission::all();

        RoleHasPermission::factory()->create([
            'role_id' => $userRole->id,
            'permission_id' => $userPermission->id
        ]);

        foreach ($adminPermission as $permission) {
            RoleHasPermission::factory()->create([
                'role_id' => $adminRole->id,
                'permission_id' => $permission->id
            ]);
        }

    }
}
