<?php

namespace Database\Factories;

use App\Models\Sms;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sms::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fake = $this->faker;

        $creator = User::query()
            ->inRandomOrder()
            ->limit(1)
            ->first();

        return [
            'user_id' => $creator->id,
            'ip_address' => $fake->ipv4,
            'text' => $fake->realText(50),
            'send_at' => Carbon::createFromTimestamp($fake->dateTime->getTimestamp()),
        ];
    }
}
