<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payload = [
            'email' => 'admin@admin.com',
            'name' => 'Admin',
            'password' => Hash::make("123123"),
            'email_verified_at' => now()
        ];

        User::create($payload);
    }
}
