<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * 1 админ и много пользователей с другими ролями
     * @return void
     */
    public function run(): void
    {
        factory(User::class)->states(User::ROLE_ADMIN)->create();
        factory(User::class, 5)->states(User::ROLE_ANONYMOUS)->create();
        factory(User::class, 20)->states(User::ROLE_GUEST)->create();
        factory(User::class, 10)->states(User::ROLE_TRAINER)->create();
    }
}
