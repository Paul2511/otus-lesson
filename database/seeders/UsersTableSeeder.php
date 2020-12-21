<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
                'password' => Hash::make('Test'),
                'email' => 'admin@smter.ru',
                'full_name' => 'Администратор',
                'phone' => '8 (999) 900-99-00',
                'remember_token' => Str::random(10),
                'is_admin' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                ]);

        User::factory()->count(10)
            ->create();
    }

}
