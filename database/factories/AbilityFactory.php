<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use App\Policies\Ability;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

        ];
    }
}
