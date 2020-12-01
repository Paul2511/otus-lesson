<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $categories = [
            [
                'title' => 'Телефоны',
                'slug' => Str::slug('Телефоны'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => null
            ],
            [
                'title' => 'Компьютеры',
                'slug' => Str::slug('Компьютеры'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => null
            ],
            [
                'title' => 'Недвижимость',
                'slug' => Str::slug('Недвижимость'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => null
            ],
            [
                'title' => 'Транспорт',
                'slug' => Str::slug('Транспорт'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => null
            ],
            [
                'title' => 'Мобильные телефоны',
                'slug' => Str::slug('Мобильные телефоны'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 1
            ],
            [
                'title' => 'Аксессуары',
                'slug' => Str::slug('Аксессуары'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 1
            ],
            [
                'title' => 'Ноутбуки',
                'slug' => Str::slug('Ноутбуки'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 2
            ],
            [
                'title' => 'Комплектующие',
                'slug' => Str::slug('Комплектующие'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 2
            ],
            [
                'title' => 'Квартиры',
                'slug' => Str::slug('Квартиры'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 3
            ],
            [
                'title' => 'Дома',
                'slug' => Str::slug('Дома'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 3
            ],
            [
                'title' => 'Легковые автомобили',
                'slug' => Str::slug('Легковые автомобили'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 4
            ],
            [
                'title' => 'Спецтехника',
                'slug' => Str::slug('Спецтехника'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 4
            ],
            [
                'title' => 'Apple',
                'slug' => Str::slug('Apple'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 5
            ],
            [
                'title' => 'Samsung',
                'slug' => Str::slug('Samsung'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 5
            ],
            [
                'title' => 'Xiaomi',
                'slug' => Str::slug('Xiaomi'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 5
            ],
            [
                'title' => 'Наушники',
                'slug' => Str::slug('Наушники'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 6
            ],
            [
                'title' => 'Зарядки',
                'slug' => Str::slug('Зарядки'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 6
            ],
            [
                'title' => 'Чехлы',
                'slug' => Str::slug('Чехлы'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 6
            ],
            [
                'title' => 'Acer',
                'slug' => Str::slug('Acer'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 7
            ],
            [
                'title' => 'HP',
                'slug' => Str::slug('HP'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 7
            ],
            [
                'title' => 'ASUS',
                'slug' => Str::slug('ASUS'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 7
            ],
            [
                'title' => 'Видеокарты',
                'slug' => Str::slug('Видеокарты'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 8
            ],
            [
                'title' => 'Материнские платы',
                'slug' => Str::slug('Материнские платы'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 8
            ],
            [
                'title' => 'ОЗУ',
                'slug' => Str::slug('ОЗУ'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 8
            ],
            [
                'title' => 'Аренда посуточно',
                'slug' => Str::slug('Аренда посуточно'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 9
            ],
            [
                'title' => 'Аренда долгосрочно',
                'slug' => Str::slug('Аренда долгосрочно'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 9
            ],
            [
                'title' => 'Продажа',
                'slug' => Str::slug('Продажа'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 9
            ],
            [
                'title' => 'Аренда посуточно',
                'slug' => Str::slug('Аренда посуточно'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 10
            ],
            [
                'title' => 'Аренда долгосрочно',
                'slug' => Str::slug('Аренда долгосрочно'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' =>10
            ],
            [
                'title' => 'Продажа',
                'slug' => Str::slug('Продажа'),
                'status' => Category::STATUS_ACTIVE,
                'thumbnail' => $faker->imageUrl(300,200,'technics'),
                'parent_id' => 10
            ],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
