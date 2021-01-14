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
        User::factory()->create(['email'    => env('USER_TEST_EMAIL'),
                                 'password' => Hash::make(env('USER_TEST_PASSWORD')),
                                 'is_admin' => 1, 'is_active' => 1]);
        User::factory()->count(10)
            ->create();
    }

}
