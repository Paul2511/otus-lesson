<?php

namespace Database\Seeders;

use App\Models\Role;
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
        User::factory()->count(5)->create();

        $payload = [
            'email' => 'user@mail.com',
            'name' => 'Admin',
            'password' => Hash::make("123123123"),
            'email_verified_at' => now()
        ];

        $user = User::create($payload);
        $user->hasRole()->create([
            'user_id' => $user->id,
            'role_id' => Role::where('title', Role::ADMIN_ROLE)->first()->id
        ]);

    }
}
