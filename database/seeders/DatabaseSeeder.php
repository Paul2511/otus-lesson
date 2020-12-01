<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\SectionGroup;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SectionGroupsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PriceTypesTableSeeder::class);
        $this->call(AdvsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        
        User::all()->each(function (User $user)
        {
            $user->city_id = City::all()->random()->id;
            $user->save();
        });
    }
}
