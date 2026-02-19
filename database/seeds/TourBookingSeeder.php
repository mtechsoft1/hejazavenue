<?php
namespace Database\Seeds;
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
            'pickup_point_id' => '1',
            'payment_method' => 'credit_card',
            'payment_amount' => '1000',
            'payment_type' => 'partial',
            'paid' => '1000', // Use existing 'paid' column instead of 'is_paid'
            'remaining' => '0',
            'status' => 'completed',
        ]);
        TourBooking::create([
            'tour_id' => 2,
            'user_id' => 2,
            'package_type' => 'family',
            'pickup_point_id' => '1',
            'adults_in_number' => '2',
            'kids_between_3_to_8' => '2', // Use existing column name
            'payment_method' => 'credit_card',
            'payment_amount' => '1000',
            'payment_type' => 'partial',
            'paid' => '1000', // Use existing 'paid' column instead of 'is_paid'
            'remaining' => '0',
            'status' => 'completed',
        ]);
    }
}