<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param User $model
     * @return void
     */
    public function run(User $model)
    {
        $model::factory(150)->create();
    }
}
