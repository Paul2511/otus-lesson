<?php

namespace Database\Seeders;

use App\Models\Advert;
use App\Models\AdvertImage;
use Illuminate\Database\Seeder;

class AdvertsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Advert::all() as $advert) {
            AdvertImage::factory()->create([
                'advert_id' => $advert->id
            ]);
        }
        foreach(Advert::all() as $advert) {
            AdvertImage::factory()->create([
                'advert_id' => $advert->id
            ]);
        }


    }
}
