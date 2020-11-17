<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

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
            'type' => $fake->randomElement([Event::TYPE_SYSTEM, Event::TYPE_POST, Event::TYPE_SMS]),
            'slug' => $fake->slug,
            'level' => $fake->randomElement([Event::LEVEL_INFO, Event::LEVEL_WARNING, Event::LEVEL_CRITICAL]),
            'data' => $fake->realText(100),
        ];
    }
}

