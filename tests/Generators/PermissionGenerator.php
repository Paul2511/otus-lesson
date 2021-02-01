<?php


namespace Tests\Generators;


use App\Models\Permission;

class PermissionGenerator
{
    public static function generatePermission(string $permissionName)
    {
        $data = [
            'title' => $permissionName
        ];
        return self::generate($data);
    }


    private static function generate(array $data)
    {
        return Permission::factory()->create($data);

    }

}
