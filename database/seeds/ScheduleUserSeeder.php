<?php

use App\Models\Schedule;
use App\Models\ScheduleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class ScheduleUserSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()->where('role', User::ROLE_GUEST)->pluck('id')->toArray();
        $scheduleIds = Schedule::query()->pluck('id')->toArray();

        $schedules = factory(ScheduleUser::class, 10)->make()->each(function ($schedule) use ($userIds, $scheduleIds) {
            factory(ScheduleUser::class)->make();
            $schedule->user_id = (int)array_rand(array_flip($userIds));
            $schedule->schedule_id = (int)array_rand(array_flip($scheduleIds));
        })->toArray();

        ScheduleUser::query()->insert($schedules);
    }
}
