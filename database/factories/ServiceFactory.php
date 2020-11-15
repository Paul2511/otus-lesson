<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Document;
use App\Models\Service;
use App\Models\Specialist;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'specialist_uuid' => Specialist::factory(),
            'service_uuid' => $this->faker->uuid,
            'sent_fms' => $this->faker->boolean(),
            'rnr_date' => now(),
            'inbox_num' => $this->faker->unique()->numberBetween(1000000,9999999),
            'rnr_status' => $this->faker->randomDigit,
            'rnr_ready' => now(),
            'rnr_recieved' => now(),
            'invite_sent' => now(),
            'invite_status' => $this->faker->randomDigit,
            'invite_po' => now(),
            'invite_recieved' => now(),
            'visa_sent' => now(),
            'visa_status' => $this->faker->randomDigit,
            'visa_po' => now(),
            'visa_recieved' => now(),
            'specialist_status' => $this->faker->randomDigit,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }


}
