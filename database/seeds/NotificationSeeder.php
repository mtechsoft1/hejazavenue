<?php

use Illuminate\Database\Seeder;
use App\Notification;
class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'notification_from' => 1,
            'notification_to' => 2,
            'notification' => 'Your Booking Has Been Confirmed!',
        ]);
    }
}
