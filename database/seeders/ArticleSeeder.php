<?php

namespace Database\Seeders;


use App\Models\Article;
use Illuminate\Database\Seeder;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Article $model
     * @return void
     */
    public function run(Article $model)
    {
        $model::factory(50)->create();
    }
}
