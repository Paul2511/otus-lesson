<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CountryTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=json_decode(Storage::disk('public')->get('countries.json'),true);
        foreach ($data as $country){
            Country::create([
                'country_code' => $country['alpha3Code'],
                'country_name' => $country['name'],
                'capital'  => $country['capital'],
                'languages' => $country['languages']
            ]);
        }
    }
}
