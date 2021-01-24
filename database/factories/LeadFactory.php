<?php

namespace Database\Factories;

use Support\Phone\Fakers\PhoneNumberProvider;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\States\Lead\Status\SpecialistLeadStatus;
use App\States\Lead\Type\IncomingCallLeadType;
use App\States\Lead\Type\OutgoingCallLeadType;
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
        $types = Lead::getStatesFor('type')->all();
        $type = $this->faker->randomElement($types);

        $statuses = Lead::getStatesFor('status')
            ->filter(function($status){
                return $status !== SpecialistLeadStatus::$name;
            })->all();
        $status = $this->faker->randomElement($statuses);

        $internalPhone = null;
        $externalPhone = null;

        if (in_array($type, [IncomingCallLeadType::$name, OutgoingCallLeadType::$name])) {
            $this->faker->addProvider(new PhoneNumberProvider($this->faker));

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
