<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_uuid' => $this->faker->unique()->uuid,
            'name' =>  $this->faker->company,
            'full_name' => $this->faker->company.' '.$this->faker->companySuffix,
            'inn' => $this->faker->unique()->numberBetween(1110000000,9999999999),
            'kpp' => $this->faker->unique()->numberBetween(9990000000,9999999999),
            'ogrn' => mt_rand(100000000000, 999999999999),
            'ogrn_date' => now(),
            'phone' => $this->faker->unique()->numberBetween(9990000000,9999999999),
            'address_legal' => $this->faker->address,
            'address_actual' => $this->faker->address,
            'card_num' => $this->faker->numberBetween(1000000,999999),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
