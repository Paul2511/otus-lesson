<?php

namespace Database\Factories;

use App\Models\AdvertImage;
use DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdvertImageFactory extends Factory
{
    protected $model = AdvertImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thumbnail' => $this->faker->imageUrl(300,200,'technics'),
            'advert_id' => function () {
                return DB::table('adverts')
                    ->inRandomOrder()
                    ->first()->id;
            },
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
