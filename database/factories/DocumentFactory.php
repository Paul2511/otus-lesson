<?php

namespace Database\Factories;

use DB;
use App\Models\Document;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word.'jpg',
            'type' => $this->faker->mimeType,
            'url' => $this->faker->imageUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }


}
