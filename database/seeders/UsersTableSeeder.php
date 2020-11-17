<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
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
        // администраторы
        $admins = User::factory(2)
            ->create();
        foreach($admins as $admin) {
            $admin
                ->roles()
                ->save(
                    Role::query()
                        ->where('level', Role::LEVEL_ADMIN)
                        ->limit(1)
                        ->first()
                );
        }

        // редакторы
        $redactors = User::factory(4)
            ->create();
        foreach($redactors as $redactor) {
            $redactor
                ->roles()
                ->save(
                    Role::query()
                        ->where('level', Role::LEVEL_REDACTOR)
                        ->limit(1)
                        ->first()
                );
        }

        // модераторы
        $moderators = User::factory(6)
            ->create();
        foreach($moderators as $moderator) {
            $moderator
                ->roles()
                ->save(
                    Role::query()
                        ->where('level', Role::LEVEL_MODERATOR)
                        ->limit(1)
                        ->first()
                );
        }

        // пользователи
        $users = User::factory(20)
            ->create();
        foreach($users as $user) {
            $user
                ->roles()
                ->save(
                    Role::query()
                        ->where('level', Role::LEVEL_USER)
                        ->limit(1)
                        ->first()
                );
        }
    }
}
