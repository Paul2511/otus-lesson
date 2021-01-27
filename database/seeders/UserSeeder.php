<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'test',
            'email'             => 'test@test.com',
            'password'          => Hash::make('1234567890'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);

        /*for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name'     => Str::random(10),
                'email'    => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }*/
    }
}
