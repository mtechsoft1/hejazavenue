<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Main database seeder – Laravel 11 professional structure.
 * Run: php artisan db:seed
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DestinationSeeder::class,
            TourSeeder::class,
            TourBookingSeeder::class,
            NotificationSeeder::class,
            TourPickupPointSeeder::class,
            GallarySeeder::class,
        ]);
    }
}
