<?php

use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (self::getDefaultTimes() as $i => $time) {
            factory(Time::class, 1)->states($i)->create();
        }
    }

    public static function getDefaultTimes(): array
    {
        $times = [];
        $t = Carbon::createFromTimeString('06:00:00');
        foreach (range(0, 8) as $i) {
            $tNext = $t;
            $times[] = [
                'start' => $t->format('H:i:s'),
                'end' => $tNext->addHours(2)->format('H:i:s'),
            ];
            $t = $tNext;
        }

        return $times;
    }
}
