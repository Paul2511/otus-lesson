<?php

namespace Database\Factories;

use App\Models\Advert;
use App\Models\Region;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Str;

class AdvertFactory extends Factory
{
    protected $model = Advert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(2),
            'address' => $this->faker->address,
            /*'status' => Advert::STATUS_ACTIVE,
            'is_premium' => $this->faker->randomNumber(),*/
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'category_id' => function () {
                return DB::table('categories')
                    ->whereNotNull('parent_id')
                    ->whereNotIn('id', [1, 2, 3,4])
                    ->inRandomOrder()
                    ->first()->id;
            },

            'region_id' => function () {
                return DB::table('regions')
                    ->whereNotNull('parent_id')
                    ->inRandomOrder()
                    ->first()->id;
            },
            'user_id' => function () {
                return DB::table('users')
                    ->inRandomOrder()
                    ->first()->id;
            },
        ];
    }
}
