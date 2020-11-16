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
        $statusData = range(10, 110, 10);
        return [
            'specialist_uuid' => Specialist::factory(),
            'service_uuid' => $this->faker->uuid,
            'sent_fms' => $this->faker->boolean(),
            'rnr_date' => now(),
            'inbox_num' => $this->faker->unique()->numberBetween(10000,99999),
            'rnr_status' => $this->faker->randomElement($statusData),
            'rnr_ready' => now(),
            'rnr_recieved' => now(),
            'invite_sent' => now(),
            'invite_status' => $this->faker->randomElement($statusData),
            'invite_po' => now(),
            'invite_recieved' => now(),
            'visa_sent' => now(),
            'visa_status' => $this->faker->randomElement($statusData),
            'visa_po' => now(),
            'visa_recieved' => now(),
            'specialist_status' => $this->faker->randomElement($statusData),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }


}
