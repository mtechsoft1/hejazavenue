<?php

namespace Database\Seeders;

use App\TourPickupPoint;
use Illuminate\Database\Seeder;

/**
 * Seeds tour pickup points (Laravel 11 structure).
 * Depends on: TourSeeder.
 */
class TourPickupPointSeeder extends Seeder
{
    public function run(): void
    {
        TourPickupPoint::create([
            'tour_id' => 1,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2025-10-09',
            'pickup_time' => '10:00 AM',
        ]);
    }
}
