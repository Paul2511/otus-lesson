<?php

namespace Database\Seeders;

use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Specialization;

/**
 * Создает специалистов
 * Class SpecSeeder
 * @package Database\Seeders
 */
class SpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->create([
            'role' => User::ROLE_SPEC
        ])->each(function (User $user) {

            /** @var Specialization|null $specialization */
            $specialization = Specialization::orderByRaw('RAND()')->where('id', '!=', 1)->take(1)->first();

            UserDetail::factory()->createOne([
                'user_id' => $user->id,
                'classifier' => UserDetail::CLASSIFIER_SPEC_ALLOWED,
                'specialization_id' => $specialization->id
            ]);
        });
    }
}
