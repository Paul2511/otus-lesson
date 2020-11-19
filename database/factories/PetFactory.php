<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\PetType;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /** @var User|null $user */
        $user = User::query()->client()->orderByRaw('RAND()')->take(1)->first();
        /** @var PetType|null $petType */
        $petType = PetType::orderByRaw('RAND()')->where('id', '!=', 1)->take(1)->first();

        if (!$user || !$petType) {
            return abort(500);
        }

        $sex = $this->faker->randomElement(array_keys(Pet::sexLabels()));

        //Для генерации клички подключаем свой фейкер
        $this->faker->addProvider(new \App\Fakers\AnimalNameProvider($this->faker));
        $name = $this->faker->animalName($sex);

        return [
            'pet_type_id' => $petType->id,
            'client_id' => $user->id,
            'name' => $name,
            'sex' => $sex,
            'age' => $this->faker->numberBetween(1, 12*20)
        ];
    }
}
