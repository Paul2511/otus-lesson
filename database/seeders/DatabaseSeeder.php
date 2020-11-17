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
        //$this->call(PetTypesTableSeeder::class);
        //$this->call(SpecializationsTableSeeder::class);

        $this->call(ClientSeeder::class); //Создаем клиентов с зависимостями
        Pet::factory(10)->create(); //Создаем питомцев
        $this->call(SpecSeeder::class); //Создаем специалистов
    }
}
