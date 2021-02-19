<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\PetType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PetTypesTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);

        $this->call(ClientSeeder::class);
        Pet::factory(10)->create();

        \Artisan::call('scout:flush', ['model'=>Pet::class]);
        \Artisan::call('scout:import', ['model'=>Pet::class]);

        $this->call(SpecialistSeeder::class);

        \Artisan::call('scout:flush', ['model'=>User::class]);
        \Artisan::call('scout:import', ['model'=>User::class]);
    }
}
