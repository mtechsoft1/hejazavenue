<?php

use Illuminate\Database\Seeder;
use App\TourBooking;
class TourBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TourBooking::create([
            'tour_id' => 1,
            'user_id' => 2,
            'package_type' => 'per_person',
            'pickup_point_id' => 1,
            'payment_method' => 'credit_card',
            'payment_amount' => 1000,
            'payment_type' => 'partial',
            'is_paid' => 'true',
        ]);

        TourBooking::create([
            'tour_id' => 2,
            'user_id' => 2,
            'package_type' => 'family',
            'pickup_point_id' => 1,
            'adults_in_number' => 2,
            'children_in_number' => 2,
            'payment_method' => 'credit_card',
            'payment_amount' => 1000,
            'payment_type' => 'partial',
            'is_paid' => 'true',
            'status' => 'completed',
        ]);
    }
}
