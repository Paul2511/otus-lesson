<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Translation $model
     * @return void
     */
    public function run(Translation $model)
    {
        // @todo Works correctly, but I don't like that way
        //$model::factory(50)->create();
    }

    public function clearTables(Translation $model): void
    {
        $model::truncate();
    }
}
