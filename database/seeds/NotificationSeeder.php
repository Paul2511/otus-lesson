<?php

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $types = array_merge(Notification::getTypesForGuest(), Notification::getTypesForAdmin());
        foreach ($types as $name => $type) {
            factory(Notification::class, 10)->states($name)->create();
        }
    }
}
