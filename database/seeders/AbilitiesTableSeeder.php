<?php


namespace Database\Seeders;


use App\Policies\Ability;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;


class AbilitiesTableSeeder extends Seeder
{
    public function run()
    {
        $abilities = [
            [User::class => [
                Ability::VIEW_ANY,
                Ability::VIEW,
                Ability::CREATE,
                Ability::UPDATE,
                Ability::STORE,
                Ability::DELETE]
            ],
            [User::class => [
                Ability::VIEW_ANY,
                Ability::VIEW,
                Ability::DELETE
            ],
            ],
        ];
        foreach ($abilities as $ability) {
        DB::table('abilities')->insert(['ability' => json_encode($ability)]);
        }
    }
}