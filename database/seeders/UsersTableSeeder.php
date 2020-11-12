<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
        'login' => 'admin',
        'password' => 'Test',
        'email' => 'admin@smter.ru',
        'full_name' => 'Администратор',
        'is_admin' => 1,
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now(),
        ]);
    }
}
