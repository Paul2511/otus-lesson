<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Edata',
            'email' => 'info@edata.biz',
            'password' => Hash::make('LqGr5xeeGwLs445m'),
            'type' => User::TYPE_ADMIN,
            'status' => User::STATUS_ACTIVE
        ]);
        User::factory(50)->create();

    }
}
