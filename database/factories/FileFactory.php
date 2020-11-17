<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fake = $this->faker->unique();
        $name = $fake->words(6, true);
        $file = $fake->file('/tmp', storage_path('app'));

        return [
            'external_hash' => $fake->uuid,
            'name_view' => $name,
            'name_raw' => $fake->slug,
            'path' => $file,
            'extension' => $fake->fileExtension,
            'mime' => $fake->mimeType,
            'size' => $fake->randomNumber(),
        ];
    }
}
