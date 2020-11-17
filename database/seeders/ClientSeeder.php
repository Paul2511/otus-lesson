<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Lead;

/**
 * Создает клиентов и заполняет зависимые таблицы
 * Class ClientSeeder
 * @package Database\Seeders
 */
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create([
            'role' => User::ROLE_CLIENT
        ])->each(function (User $user) {

            UserDetail::factory()->createOne([
               'user_id' => $user->id,
               'classifier' => UserDetail::CLASSIFIER_CLIENT_TARGET
            ]);

            $count = rand(1,3);
            Lead::factory()->count($count)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
