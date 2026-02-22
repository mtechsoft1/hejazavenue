<?php

namespace Database\Seeders;

use App\Notification;
use Illuminate\Database\Seeder;

/**
 * Seeds notifications (Laravel 11 structure).
 * Depends on: UserSeeder.
 */
class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::create([
            'notification_from' => 1,
            'notification_to' => 2,
            'notification' => 'Your Booking Has Been Confirmed!',
        ]);
    }
}
