<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\PetType;
use App\Models\User;
use App\States\User\Role\ClientUserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Support\Pet\Fakers\PetNameProvider;
class PetTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PetType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->word
        ];
    }
}
