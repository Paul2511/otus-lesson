<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\PetType;
use App\Models\Translate;
use App\Models\User;
use App\States\User\Role\ClientUserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Support\Pet\Fakers\PetNameProvider;
class TranslateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Translate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->word
        ];
    }
}
