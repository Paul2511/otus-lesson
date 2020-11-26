<?php

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        foreach (self::getTypes() as $name => $type) {
            factory(Notification::class, 10)->states($name)->create();
        }
    }

    /**
     * @return array
     */
    public static function getTypes(): array
    {
        $types = [];
        foreach (Notification::TYPES as $item) {
            $types[trans('notifications.types.' . $item)] = $item;
        }

        return $types;
    }
}
