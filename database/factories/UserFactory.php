<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /*$regionsID = Region::whereNotNull('parent_id')->pluck('id')->toArray();*/
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'last_login_at' => now(),
            'role_id' => Role::ROLE_USER,
            'region_id' => function () {
                return DB::table('regions')
                        ->whereNotNull('parent_id')
                        ->inRandomOrder()
                        ->first()->id;
            },
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
