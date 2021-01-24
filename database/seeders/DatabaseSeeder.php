<?php

namespace Database\Seeders;

use App\Models\Pet;
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

        $this->call(SpecialistSeeder::class);
    }
}
