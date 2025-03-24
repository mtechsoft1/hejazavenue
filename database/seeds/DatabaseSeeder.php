<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);  
        $this->call(DestinationSeeder::class);  
        $this->call(TourSeeder::class);
        $this->call(TourBookingSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(TourPickupPointSeeder::class);
        $this->call(GallarySeeder::class);
    }
}
