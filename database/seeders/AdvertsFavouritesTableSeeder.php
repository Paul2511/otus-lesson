<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AdvertsFavouritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('advert_favourites')->insert([
                'user_id' => DB::table('users')
                    ->inRandomOrder()
                    ->first()->id
                ,
                'advert_id' => DB::table('adverts')
                    ->inRandomOrder()
                    ->first()->id
                ,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }



    }
}
