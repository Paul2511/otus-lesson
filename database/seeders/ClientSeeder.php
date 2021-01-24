<?php

namespace Database\Seeders;

use App\Models\Client;
use App\States\User\Role\ClientUserRole;
use Illuminate\Database\Seeder;
use App\Models\User;
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
            'role' => ClientUserRole::class
        ])->each(function (User $user) {
            $count = rand(1,3);
            Lead::factory()->count($count)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
