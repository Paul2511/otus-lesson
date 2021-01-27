<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\PermissionRole;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('title', Role::ADMIN_ROLE)->first();
        $userRole = Role::where('title',Role::USER_ROLE)->first();

        $userPermission = Permission::where('title', Permission::VIEW)->first();
        $adminPermission = Permission::all();

        PermissionRole::factory()->create([
            'role_id' => $userRole->id,
            'permission_id' => $userPermission->id
        ]);

        foreach ($adminPermission as $permission) {
            PermissionRole::factory()->create([
                'role_id' => $adminRole->id,
                'permission_id' => $permission->id
            ]);
        }

    }
}
