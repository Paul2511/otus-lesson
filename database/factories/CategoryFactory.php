<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        DB::table('categories')->insert([
            ['parent_id'=>0,'title'=>'Товары', 'status'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['parent_id'=>0,'title'=>'Услуги', 'status'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['parent_id'=>1,'title'=>'Компьютеры', 'status'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['parent_id'=>1,'title'=>'Авто', 'status'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['parent_id'=>1,'title'=>'Телефоны', 'status'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['parent_id'=>1,'title'=>'Электроника и Фото', 'status'=>1, 'created_at'=>now(), 'updated_at'=>now()],
        ]);
        return [
            
        ];
    }
}
