<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;


class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Restaurant $model
     * @return void
     */
    public function run(Restaurant $model)
    {
        $model::factory(150)->create();
    }
}
