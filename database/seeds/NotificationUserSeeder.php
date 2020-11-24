<?php

use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userIds = User::query()->where('role', User::ROLE_GUEST)->pluck('id')->toArray();
        $notificationIds = Notification::query()->pluck('id')->toArray();

        $notifications = factory(NotificationUser::class, 10)->make()->each(function ($notification) use ($userIds, $notificationIds) {
            factory(NotificationUser::class)->make();
            $notification->user_id = (int)array_rand(array_flip($userIds));
            $notification->notification_id = (int)array_rand(array_flip($notificationIds));
        })->toArray();

        NotificationUser::query()->insert($notifications);
    }
}
