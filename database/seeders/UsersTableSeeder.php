<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;


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
                'password' => 'Test',
                'email' => 'admin@smter.ru',
                'full_name' => 'Администратор',
                'is_admin' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                ]);

        User::factory()->count(10)
            ->create();
    }

}
