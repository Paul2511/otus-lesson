<?php

namespace Database\Seeders;

use App\Models\User;
use App\States\User\Role\SpecialistUserRole;
use Illuminate\Database\Seeder;
use App\Models\Specialization;
use App\Models\Specialist;
class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->make([
            'role' => SpecialistUserRole::class
        ])->each(function (User $user) {

            /** @var Specialization|null $specialization */
            $specialization = Specialization::orderByRaw('RAND()')->where('id', '!=', 1)->take(1)->first();

            $user->specialistData = [
                'specialization_id'=>$specialization->id
            ];
            $user->save();
        });
    }
}
