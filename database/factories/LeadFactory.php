<?php

namespace Database\Factories;

use App\Faker\CustomPhoneProvider;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lead::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement(array_keys(Lead::$typeLabels));

        $statuses = Lead::$statusLabels;
        unset($statuses[Lead::STATUS_SPEC]);
        $status = $this->faker->randomElement(array_keys($statuses));

        $internalPhone = null;
        $externalPhone = null;

        if (in_array($type, [Lead::TYPE_OUTGOING_CALL, Lead::TYPE_INCOMING_CALL])) {
            $this->faker->addProvider(new CustomPhoneProvider($this->faker));

            $internalPhone = $this->faker->phoneNumber;
            $externalPhone = $this->faker->phoneNumber;
        }

        return [
            'type' => $type,
            'status' => $status,
            'internal_phone' => $internalPhone,
            'external_phone' => $externalPhone
        ];
    }
}
