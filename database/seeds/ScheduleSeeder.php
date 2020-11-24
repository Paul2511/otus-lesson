<?php

use App\Models\Gym;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Time;
use App\Models\User;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $trainerIds = User::query()->where('role', User::ROLE_TRAINER)->pluck('id')->toArray();
        $timeIds = Time::query()->pluck('id')->toArray();
        $sectionIds = Section::query()->pluck('id')->toArray();
        $gymIds = Gym::query()->pluck('id')->toArray();

        $schedules = factory(Schedule::class, 20)->make()->each(function ($schedule) use ($trainerIds, $timeIds, $sectionIds, $gymIds) {
            factory(Schedule::class)->make();
            $schedule->user_id = (int)array_rand(array_flip($trainerIds));//trainer
            $schedule->time_id = (int)array_rand(array_flip($timeIds));
            $schedule->section_id = (int)array_rand(array_flip($sectionIds));
            $schedule->gym_id = (int)array_rand(array_flip($gymIds));
        })->toArray();

        Schedule::query()->insert($schedules);
    }
}
