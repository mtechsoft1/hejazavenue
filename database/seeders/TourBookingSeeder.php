<?php

namespace Database\Seeders;

use App\TourBooking;
use Illuminate\Database\Seeder;

/**
 * Seeds tour bookings (Laravel 11 structure).
 * Depends on: UserSeeder, TourSeeder, TourPickupPointSeeder (if pickup_point_id used).
 */
class TourBookingSeeder extends Seeder
{
    public function run(): void
    {
        TourBooking::create([
            'tour_id' => 1,
            'user_id' => 2,
            'package_type' => 'per_person',
            'pickup_point_id' => '1',
            'payment_method' => 'credit_card',
            'payment_amount' => '1000',
            'payment_type' => 'partial',
            'paid' => '1000',
            'remaining' => '0',
            'status' => 'completed',
        ]);

        TourBooking::create([
            'tour_id' => 2,
            'user_id' => 2,
            'package_type' => 'family',
            'pickup_point_id' => '1',
            'adults_in_number' => '2',
            'kids_between_3_to_8' => '2',
            'payment_method' => 'credit_card',
            'payment_amount' => '1000',
            'payment_type' => 'partial',
            'paid' => '1000',
            'remaining' => '0',
            'status' => 'completed',
        ]);
    }
}
